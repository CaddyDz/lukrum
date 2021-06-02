<?php


namespace App\utils\Pmc\Assets\Blue;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class BlueImageLinkedIn extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619119064/pmc/assets/xlsuvuhmwlqxjq4bhelj.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/xlsuvuhmwlqxjq4bhelj";
    }

    public function GetBaseColor(): string {
        return "#459CD5";
    }

    public function params()
    {
        // 0.25252525252525254
        // 27 - 27 - 1.20
        // 7.4 - 0.475 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 1584, 'h' => 768, ],
            'logo' => ['x' => 71, 'y' => 69, 'w' => 269, 'h' => 113, ],
            'cta' => ['l' => 78, 'r' => 963, 'y' => 641, 'h' => 40, 'c' => 'white', 's' => 2.5, ],
            'headline' => ['l' => 71, 'r' => 37, 'y' => 250, 'c' => "black", 'sc' => "black", 's' => 1.7966666668, ],
            'bodyText' => ['position' => 'below', 'p' => 25, 'l' => 71, 'r' => 378, 'c' => "white", 's' => 3.2, ],


            'overlay' => [
                'x' => 1040, 'y' => 60, 'w' => 471, 'h' => 118,
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
