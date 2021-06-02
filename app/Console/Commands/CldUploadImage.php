<?php

namespace App\Console\Commands;

use App\utils\Pmc\ImageUpload\Exceptions\ImageUploadException;
use App\utils\Pmc\ImageUpload\ImageChecker;
use App\utils\Pmc\ImageUpload\ImageDataAccessAbstract;
use App\utils\Pmc\ImageUpload\ImageUploader;
use App\utils\Pmc\Instances\InstancesManager;
use App\utils\Pmc\PmcForm;
use Illuminate\Console\Command;

class CldUploadImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cld:upload-image {--hash=?} {--image=?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload Local Image to Cloudinary';

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

        $allowedImageTypes = ['logo', 'overlay', 'profile', ];
        $imageType = $this->option('image');
        if(!in_array($imageType, $allowedImageTypes)) {
            $this->info("Image Type has to be One of the following: ".implode(', ', $allowedImageTypes));
            return 0;
        }

        $pmc = PmcForm::FromHash($hash);

//dump($pmc);
        if(!$pmc) {
            $this->info("Unknown Hash");
            return 0;
        }

        InstancesManager::instance()->forceCode($pmc->GetModel()->instance);

        $dataAccess = ImageDataAccessAbstract::Create($pmc, $imageType);
        $checker = new ImageChecker($dataAccess);
        try {
            $checkResponse = $checker->Check();
        } catch (ImageUploadException $e) {
            $this->error(get_class($e));
            $this->error($e->getMessage());
            return 1;
        }

        if($checkResponse) {
            $this->info("Already Uploaded. Exiting.");
            return 0;
        }

        try {
            (new ImageUploader($dataAccess))->Upload();
        } catch (\Exception $e) {
            $this->error(get_class($e));
            $this->error($e->getMessage());
            return 1;
        }

        $this->info("Uploaded OK");

        return 0;
    }
}
