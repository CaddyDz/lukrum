<?php


namespace App\utils\Pmc\Assets\Simple;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class SimpleImageTwitter extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619701641/pmc/assets/leaf24nnu06chpkdjk1t.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/leaf24nnu06chpkdjk1t";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        // 0.33333333
        // 3.24 - 27 - 1.20
        // 1.48 - 0.68 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 900, 'h' => 450, ],
            'logo' => ['x' => 32, 'y' => 33, 'w' => 145, 'h' => 58, ],
            'cta' => ['l' => 44, 'r' => 478, 'y' => 391, 'h' => 40, 'c' => 'white', 's' => 1.5, ],
            'headline' => ['l' => 44, 'r' => 30, 'y' => 135, 'c' => "asset", 'sc' => "black", 's' => 1.5, ],
            'bodyText' => ['position' => 'below', 'p' => 10, 'l' => 44, 'r' => 40, 'c' => "black", 's' => 1.4, ],
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
