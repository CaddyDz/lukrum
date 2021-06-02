<?php


namespace App\utils\Pmc\Assets\Blue;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class BlueImageInstagram extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619118939/pmc/assets/wjuo4vnldsxhdbmxy2f0.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/wjuo4vnldsxhdbmxy2f0";
    }

    public function GetBaseColor(): string {
        return "#459CD5";
    }

    public function params()
    {
        // 0.37037037037037035
        // 3.24 - 27 - 1.20
        // 7.4 - 0.475 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 1080, 'h' => 1080, ],
            'logo' => ['x' => 81, 'y' => 62, 'w' => 271, 'h' => 120, ],
            'cta' => ['l' => 322, 'r' => 322, 'y' => 968, 'h' => 40, 'c' => 'white', 's' => 1.95, ],
            'headline' => ['l' => 81, 'r' => 47, 'y' => 205, 'c' => "black", 'sc' => "black", 's' => 2, ],
            'bodyText' => ['position' => 'below', 'p' => 22, 'l' => 81, 'r' => 47, 'c' => "white", 's' => 3, ],


            'overlay' => [
                'x' => 541, 'y' => 58, 'w' => 472, 'h' => 119,
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
