<?php


namespace App\utils\Pmc\Assets\Blue;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class BlueImageTwitter extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619118907/pmc/assets/wxop99uondluddckkgeq.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/wxop99uondluddckkgeq";
    }

    public function GetBaseColor(): string {
        return "#459CD5";
    }

    public function params()
    {
        // 0.33333333
        // 27 - 27 - 1.20
        // 7.4 - 0.475 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 900, 'h' => 450, ],
            'logo' => ['x' => 42, 'y' => 39, 'w' => 155, 'h' => 66, ],
            'cta' => ['l' => 55, 'r' => 480, 'y' => 361, 'h' => 40, 'c' => 'white', 's' => 1.55, ],
            'headline' => ['l' => 42, 'r' => 37, 'y' => 130, 'c' => "black", 'sc' => "black", 's' => 1.0069444444, ],
            'bodyText' => ['position' => 'below', 'p' => 10, 'l' => 42, 'r' => 225, 'c' => "white", 's' => 1.8, ],


            'overlay' => [
                'x' => 587, 'y' => 36, 'w' => 264, 'h' => 67,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617433154/pmc/assets/kg8x7ocaxip1bqb7ckup.png',
                'public_id' => 'pmc:assets:kg8x7ocaxip1bqb7ckup',
            ],
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
