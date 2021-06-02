<?php


namespace App\utils\Pmc\Assets\Slope;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class SlopeImageTwitter extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617795419/pmc/assets/obttgfwlluq2ozrb6bmi.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/obttgfwlluq2ozrb6bmi";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        // 0.4444444444444444
        // 3.24 - 27 - 1.20
        // 1.5 - 0.68 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 900, 'h' => 450, ],
            'logo' => ['x' => 46, 'y' => 24, 'w' => 169, 'h' => 71, ],
            'cta' => ['l' => 53, 'r' => 484, 'y' => 379, 'h' => 40, 'c' => 'asset', 's' => 1.4941406265, ],
            'headline' => ['l' => 46, 'r' => 15, 'y' => 130, 'c' => "white", 'sc' => "black", 's' => 1.5, ],
            'bodyText' => ['position' => 'below', 'p' => 5, 'l' => 46, 'r' => 20, 'c' => "black", 's' => 1.3, ],
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
