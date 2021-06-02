<?php


namespace App\utils\Pmc\Assets\Slope;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class SlopeImageFacebook extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617795384/pmc/assets/undflfexyknmn8cmpxix.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/undflfexyknmn8cmpxix";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        // 0.33333333
        // 3.24 - 1.44 - 1.20
        // 1.48 - 0.68 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 1200, 'h' => 630, ],
            'logo' => ['x' => 53, 'y' => 49, 'w' => 270, 'h' => 102, ],
            'cta' => ['l' => 70, 'r' => 667, 'y' => 544, 'h' => 40, 'c' => 'asset', 's' => 1.95, ],
            'headline' => ['l' => 51, 'r' => 30, 'y' => 195, 'c' => "white", 'sc' => "black", 's' => 2, ],
            'bodyText' => ['position' => 'below', 'p' => 10, 'l' => 51, 'r' => 30, 'c' => "black", 's' => 2, ],
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
