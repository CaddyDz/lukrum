<?php


namespace App\utils\Pmc\Assets\Simple;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class SimpleImageInstagram extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619701685/pmc/assets/naq8nmv7ebszgqmohrxw.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/naq8nmv7ebszgqmohrxw";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        // 0.37037037037037035
        // 3.24 - 27 - 1.20
        // 1.48 - 0.68 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 1080, 'h' => 1080, ],
            'logo' => ['x' => 72, 'y' => 72, 'w' => 255, 'h' => 101, ],
            'cta' => ['l' => 83, 'r' => 360, 'y' => 944, 'h' => 50, 'c' => 'white', 's' => 2.5, ],
            'headline' => ['l' => 78, 'r' => 85, 'y' => 265, 'c' => "asset", 'sc' => "black", 's' => 2.6, ],
            'bodyText' => ['position' => 'below', 'p' => 15, 'l' => 78, 'r' => 65, 'c' => "black", 's' => 2.55, 'lh' => 1.25, ],
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
