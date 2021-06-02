<?php


namespace App\utils\Pmc\Assets\Slope;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class SlopeImageLinkedIn extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617795462/pmc/assets/dflntqgsvmvxvfk5lbzx.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/dflntqgsvmvxvfk5lbzx";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        // 0.25252525252525254
        // 3.24 - 27 - 1.20
        // 1.5 - 0.68 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 1584, 'h' => 768, ],
            'logo' => ['x' => 74, 'y' => 57, 'w' => 272, 'h' => 109, ],
            'cta' => ['l' => 48, 'r' => 888, 'y' => 655, 'h' => 50, 'c' => 'asset', 's' => 2.5, ],
            'headline' => ['l' => 74, 'r' => 100, 'y' => 230, 'c' => "white", 'sc' => "black", 's' => 2.5, ],
            'bodyText' => ['position' => 'below', 'p' => 10, 'l' => 74, 'r' => 20, 'c' => "black", 's' => 2.7, 'lh' => 1.2, ],
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
