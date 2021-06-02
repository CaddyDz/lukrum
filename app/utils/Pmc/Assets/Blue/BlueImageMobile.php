<?php


namespace App\utils\Pmc\Assets\Blue;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class BlueImageMobile extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619118802/pmc/assets/voc2bo8w0xjwgbe1yq70.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/voc2bo8w0xjwgbe1yq70";
    }

    public function GetBaseColor(): string {
        return "#459CD5";
    }

    public function params()
    {
        return [
            'size' => ['w' => 320, 'h' => 50, ],
            'logo' => ['x' => 10, 'y' => 8, 'w' => 42, 'h' => 20, ],
            'cta' => ['l' => 258, 'r' => 12, 'y' => 24, 'h' => 30, 'c' => 'white', 's' => 0.30, ],
            'headline' => ['l' => 13, 'r' => 123, 'y' => 32, 'c' => "black", 'sc' => "black", 's' => 0.200617284, ],
            'bodyText' => ['position' => 'none', 'p' => 3, 'l' => 40, 'r' => 30, 'c' => "black", 's' => 0.6438888889, ],
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
