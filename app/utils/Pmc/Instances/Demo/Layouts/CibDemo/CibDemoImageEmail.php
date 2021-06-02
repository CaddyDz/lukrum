<?php


namespace App\utils\Pmc\Instances\Demo\Layouts\CibDemo;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class CibDemoImageEmail extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1620816266/demo/pmc/assets/nkisgr2ihhpznehh4jeh.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "demo/pmc/assets/nkisgr2ihhpznehh4jeh";
    }

    public function GetBaseColor(): string {
        return "#XXXXXX";
    }

    public function params()
    {
        // 0.26223776223776224
        // 3.24 - 1.44 - 1.20
        // 1.48 - 0.68 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 600, 'h' => 775, ],
            'logo' => ['x' => 58, 'y' => 20, 'w' => 106, 'h' => 44, ],
//            'logo2' => ['x' => 411, 'y' => 358, 'w' => 115, 'h' => 40, ],
            'cta' => ['l' => 54, 'r' => 306, 'y' => 623, 'h' => 40, 'c' => 'white', 's' => 1, ],
            'headline' => ['l' => 52, 'r' => 100, 'y' => 164, 'c' => "#0f2d5d", 's' => 1, 'ff'=>'sans-serif',],
            'intro' => ['l' => 52, 'r' => 100, 'y' => 164, 'c' => "#0f2d5d", 's' => 0.25, 'ff'=>'sans-serif', ],
            'bodyText' => ['position' => 'absolute', 'p' => 0, 'y' => 248, 'l' => 52, 'r' => 250, 'c' => "#0f2d5d", 'ff'=>'sans-serif', 's' => 0.4, 'lh' => 1.2, ],

            'footer' => ['l' => 52, 'r' => 52, 'y' => 725, 'h' => 40, 'c' => 'black', 's' => 1, ],
        ];
//        return [
//            'size' => ['w' => 300, 'h' => 600, ],
//            'logo' => ['x' => 20, 'y' => 20, 'w' => 168, 'h' => 68, ],
//            'cta' => ['l' => 24, 'r' => 24, 'y' => 542, 'h' => 30, 'c' => 'asset', ],
//            'headline' => ['l' => 28, 'r' => 18, 'y' => 150, 'c' => "white", 'sc' => "black", ],
//            'bodyText' => ['position' => 'below', 'p' => 15, 'l' => 28, 'r' => 18, 'c' => "white", ],
//        ];
    }
}
