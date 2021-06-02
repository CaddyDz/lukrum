<?php


namespace App\utils\Pmc\Instances\Demo\Layouts\CibDemo;

use App\utils\Pmc\Assets\ImageDataSourceCibSocialMedia;

class CibDemoImageInstagram extends \App\utils\Pmc\Assets\AssetImageCibAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceCibSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1620814999/demo/pmc/assets/zapdjnxn7toqijvsyimu.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "demo/pmc/assets/zapdjnxn7toqijvsyimu";
    }

    public function GetBaseColor(): string {
        return "#XXXXXX";
    }

    public function params()
    {
        // 0.33333333
        // 3.24 - 1.44 - 1.20
        // 1.48 - 0.68 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 1080, 'h' => 1080, ],
            'logo' => ['x' => 58, 'y' => 64, 'w' => 254, 'h' => 108, ],
//            'logo2' => ['x' => 645, 'y' => 400, 'w' => 288, 'h' => 96, ],
            'cta' => ['l' => 236, 'r' => 276, 'y' => 955, 'h' => 40, 'c' => 'white', 's' => 2.1, ],
            'headline' => ['l' => 86, 'r' => 30, 'y' => 600, 'c' => "asset", 'sc' => "black", 's' => 1.8, ],
            'bodyText' => ['position' => 'below', 'p' => 0, 'l' => 70, 'r' => 575, 'c' => "#0f2d5d", 'ff'=>'sans-serif', 's' => 1.7, 'lh' => 1.2, ],
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
