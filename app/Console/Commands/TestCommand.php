<?php

namespace App\Console\Commands;

use App\Mail\PmcConfirmMail;
use App\Mail\TestMail;
use App\Models\PmcForm;
use App\utils\Pmc\Assets\Cib\LayoutCib;
use App\utils\Pmc\Assets\LayoutsManager;
use App\utils\Pmc\Assets\Slope\LayoutSlope;
use App\utils\Pmc\Assets\Slope\SlopeTemplateLanding;
use App\utils\Pmc\AssetsProcessor;
use App\utils\Pmc\AssetsStorageMockery;
use App\utils\Pmc\EmailManager\EmailManager;
use App\utils\Pmc\Instances\InstancesManager;
use Cloudinary\Cloudinary;
use Cloudinary\Tag\ImageTag;
use Cloudinary\Transformation\Adjust;
use Cloudinary\Transformation\Argument\Color;
use Cloudinary\Transformation\Compass;
use Cloudinary\Transformation\Gravity;
use Cloudinary\Transformation\Overlay;
use Cloudinary\Transformation\Position;
use Cloudinary\Transformation\Resize;
use Cloudinary\Transformation\Source;
use Cloudinary\Transformation\Transformation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Util\Test;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
//        InstancesManager::instance()->forceCode('demo');
//dump(instance()->LayoutsManager());
//        dd(LayoutsManager::instance()->getLayout('Cib'));

//        dd(instance('default')->FrontEndJson());
//        dd(Mail::to([['email' => 'ahhmed@mail.ru', 'name' => 'Ivan Bibeg', ]] )->send(new TestMail()));
//
//        return;
//        dd(Storage::disk('s3')->delete(['the_company_campaign_in_a_box.zip', 'bibeg_co_custom_creative.zip', ]));
        dd(Storage::disk('s3')->allFiles());
        return;
//        $pmc = \App\utils\Pmc\PmcForm::FromModel(PmcForm::find(1));

//        dd((new LayoutSlope())->template('landing')->getRenderedHtml($pmc));
        //(new SlopeTemplateLanding())->getRenderedHtml())
//return;
//        dd((new LayoutCib())->template('landing')->getPreviewHtml());
//return;
//        dd(PmcForm::find(1)->customCreative);
//        dd((new EmailManager())->CheckEmail('ivan@bibeg.com'));
//return;
        dd((new Cloudinary())->uploadApi()->upload(public_path('img/democib_email_empty.png'), ['folder' => 'demo/pmc/assets', 'timeout' => 120, ]));

        return;

/*
        $img->overlay(
            Overlay::source(Source::image($logoId)
                ->transformation((new Transformation())->resize(Resize::pad($params->logo->w, $params->logo->h)))
            )->position((new Position())
                ->gravity(Gravity::compass(Compass::northWest()))
                ->offsetX($params->logo->x)
                ->offsetY($params->logo->y)
            )
        );

 */
        $cld = new Cloudinary();
        $assetIdentifier = 'pmc/assets/dfhdwnnwffjxnj3etuby.png';
        $x = (string)$cld->image($assetIdentifier)
            ->overlay(
                Overlay::source(Source::image($logoId)
                    ->transformation((new Transformation())->resize(Resize::pad($params->logo->w, $params->logo->h)))
                )->position((new Position())
                    ->gravity(Gravity::compass(Compass::northWest()))
                    ->offsetX($params->logo->x)
                    ->offsetY($params->logo->y)
                )
            )
//            ->adjust(Adjust::replaceColor(Color::YELLOW2)
//                ->fromColor(Color::rgb('CA574F'))
//                ->tolerance(80))
            ->toUrl();
//dd($x);

        dd($x);


//return;
        return;
        dd((new Cloudinary())->uploadApi()->upload(public_path('img/pmb_bg_mountains_resized.png'), ['folder' => 'pmc/images', ]));

        return;

        $cld = new Cloudinary();
        $assetIdentifier = 'pmc/assets/uhaeqj6idwuzaxexobzz.png';
        $x = (string)$cld->image($assetIdentifier)
            ->adjust(Adjust::replaceColor(Color::YELLOW2)
                ->fromColor(Color::rgb('CA574F'))
                ->tolerance(80))
            ->toUrl();
dd($x);

        $x = (new ImageTag('pmc/assets/gufyiev6zbvea6pxviqz.png'))
            ->overlay(
                Overlay::source(Source::image('pmc:logos:pmc:logos:gqfioh38et2ynwf0vsjv.png')
                    ->transformation((new Transformation())->resize(Resize::fit(100, 40)))
                )->position((new Position())
                    ->gravity(Gravity::compass(Compass::northWest()))
                    ->offsetX(85)
                    ->offsetY(21)
                )
            )->toTag();

return;
       dd(Mail::to([['email' => 'ahhmed@mail.ru', 'name' => 'Ivan Bibeg', ]] )->send(new PmcConfirmMail(PmcForm::find(2))));
return;
//        dd((string)(new AssetsProcessor())->ProcessForm(PmcForm::find(5)));
//        dd((new AssetsStorageMockery())->SearchById('mock2'));

return;
        $x = (new ImageTag('pmc/assets/gufyiev6zbvea6pxviqz.png'))
            ->overlay(
                Overlay::source(Source::image('pmc:logos:pmc:logos:gqfioh38et2ynwf0vsjv.png')
                    ->transformation((new Transformation())->resize(Resize::fit(100, 40)))
                )->position((new Position())
                    ->gravity(Gravity::compass(Compass::northWest()))
                    ->offsetX(85)
                    ->offsetY(21)
                )
            )->toTag();
dd($x);
return;

        $x = (new Cloudinary())->uploadApi()->upload(public_path('img/email_discover.png'), ['folder' => 'pmc/email', ]);
        dd($x);

        return;


        $c = new Cloudinary();


        $x = $c->uploadApi()->upload(public_path('img/asset1.png'), ['folder' => 'pmc/assets', ]);
dd($x);

//        dd($c->searchApi()->maxResults(30)->execute());

        \Segment::init(env('SEGMENT_WRITE_KEY'));
        \Segment::identify([
            'userId' => '627603',
            'traits' => [
                'email' => 'ivan@bibeg.com',
            ],
        ]);

        return;

        return 0;
    }

/*
array:18 [
    "asset_id" => "36adefb5e8d38ce1cbc47b293a01a1fb"
    "public_id" => "pmc/images/qdhddevdax3d9slxp48g"
    "version" => 1617112663
    "version_id" => "cfbcfe8c507e1de126e4c41ff831af27"
    "signature" => "8029fee7befd37c882cde240823bb1e2886d0113"
    "width" => 1200
    "height" => 797
    "format" => "png"
    "resource_type" => "image"
    "created_at" => "2021-03-30T13:57:43Z"
    "tags" => []
    "bytes" => 1636484
    "type" => "upload"
    "etag" => "2b174b9457ea3addca8dce143c28fa14"
    "placeholder" => false
    "url" => "http://res.cloudinary.com/pierry/image/upload/v1617112663/pmc/images/qdhddevdax3d9slxp48g.png"
    "secure_url" => "https://res.cloudinary.com/pierry/image/upload/v1617112663/pmc/images/qdhddevdax3d9slxp48g.png"
    "original_filename" => "pmb_bg_mountains_resized"
  ]

     */
}
