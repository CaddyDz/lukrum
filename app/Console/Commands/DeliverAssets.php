<?php

namespace App\Console\Commands;

use App\utils\Pmc\Assets\LayoutsManager;
use App\utils\Pmc\AssetsProcessor;
use App\utils\Pmc\ImageUpload\Contracts\ImageDataAccessContract;
use App\utils\Pmc\ImageUpload\Exceptions\ImageUploadException;
use App\utils\Pmc\ImageUpload\Exceptions\UploadInProgressException;
use App\utils\Pmc\ImageUpload\ImageChecker;
use App\utils\Pmc\ImageUpload\ImageDataAccessAbstract;
use App\utils\Pmc\ImageUpload\ImageUploader;
use App\utils\Pmc\Instances\InstancesManager;
use App\utils\Pmc\PmcForm;
use Illuminate\Console\Command;

class DeliverAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deliver:assets {--hash=?} {--sleep=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deliver Assets of the selected Form To Content Manager';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ignore_user_abort(true);
        set_time_limit(0);

        $hash = $this->option('hash');
//dump($hash);
        if('?' === $hash) {
            $this->info("Please specify form Hash as --hash=XXXXX");
            return 0;
        }

        $pmc = PmcForm::FromHash($hash);

//dump($pmc);
        if(!$pmc) {
            $this->info("Unknown Hash");
            return 0;
        }

        InstancesManager::instance()->forceCode($pmc->GetModel()->instance);

        $this->sleep();

        $this->checkImages($pmc);

        $asstUrl = (new AssetsProcessor())->SendAssetsEmail($pmc);

//        dd($x);

        \Segment::init(env('SEGMENT_WRITE_KEY'));
        $segmentResponse = \Segment::identify([
            'userId' => $pmc->ShortHash(),
            'traits' => [
                "stripeID" => $pmc->GetModel()->purchase_reference,
                "asstURL" => $asstUrl,
            ],
        ]);
        dump($segmentResponse);

        return 0;
    }


    private function checkImages(PmcForm $pmc) {
        $imagesToCheck = ['logo', ];
        $model = $pmc->GetModel();
        if('cib' === $model->path) {
            if($model->cib->profile_url) {
                $imagesToCheck[] = 'profile';
            }
        } else {
            if($layout = LayoutsManager::instance()->getLayout($model->customCreative->layout_code)) {
                if($layout->hasOverlay() && $model->customCreative->overlay_url) {
                    $imagesToCheck[] = 'overlay';
                }
            }
        }


        $fullDataAccessList = collect($imagesToCheck)->map(function($imageType) use ($pmc) {
            return ImageDataAccessAbstract::Create($pmc, $imageType);
        });

        $cancelReasons = [];
        $cancelList = $fullDataAccessList->filter(function($dataAccess) use (&$cancelReasons) {
            try {
                (new ImageChecker($dataAccess))->Check();
                return false;
            } catch (UploadInProgressException $e) {
                return false;
            } catch (ImageUploadException $e) {
                $cancelReasons[] = $e;
                return true;
            }
        });

        if(count($cancelReasons)) {
            $this->error("Some images have non-recoverable errors");
            foreach($cancelReasons as $e) {
                /**
                 * @var \Exception $e
                 */
                $this->error(get_class($e).' :: '.$e->getMessage());
            }
            exit(1);
        }


        $toUploadList = $fullDataAccessList->filter(function($dataAccess) {
            try {
                return !(new ImageChecker($dataAccess))->Check();
            } catch (\Exception $e) {
                return false;
            }
        });

        $this->info("{$toUploadList->count()} Images to Upload.");
        $toUploadList->each(function($dataAccess) {
            /**
             * @var ImageDataAccessContract $dataAccess
             */
            $this->info("Uploading {$dataAccess->getUrl()} ...");
            (new ImageUploader($dataAccess))->Upload();
            $this->info("\tDone.");
        });

        $attempts = 0;
        $maxAttempts = 5;

        do {
            $waitList = $fullDataAccessList->filter(function($dataAccess) {
                try {
                    (new ImageChecker($dataAccess))->Check();
                    return false;
                } catch (UploadInProgressException $e) {
                    return true;
                } catch (ImageUploadException $e) {
                    return false;
                }
            });

            if(0 < $waitList->count()) {
                $this->info("{$waitList->count()} Images Are Still In Progress. Sleeping 45 seconds ...");
                sleep(45);
                $this->info("\tGo on...");
            }

            $attempts++;
        }  while(0 < $waitList->count() && $attempts < $maxAttempts);

        if(0 < $waitList->count()) {
            $this->error("Some Images Are Still Not Done After {$attempts} intervals of waiting");
            exit(1);
        }
    }


    private function sleep() {
        $sleep = $this->option('sleep');
        if(is_numeric($sleep)) {
            $sleep = (int)$sleep;
            if(0 < $sleep) {
                $this->info("Sleeping {$sleep} seconds ...");
                sleep($sleep);
                $this->info("We have slept enough. Going on ...");
            }
        }
    }
}
