<?php


namespace App\utils\Pmc\Assets\Simple;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class SimpleImageLinkedIn extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619701728/pmc/assets/fpr0twwvbu1dx6vdsw6i.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/fpr0twwvbu1dx6vdsw6i";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        // 0.25252525252525254
        // 3.24 - 27 - 1.20
        // 1.48 - 0.68 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 1584, 'h' => 768, ],
            'logo' => ['x' => 42, 'y' => 60, 'w' => 231, 'h' => 100, ],
            'cta' => ['l' => 55, 'r' => 971, 'y' => 680, 'h' => 40, 'c' => 'white', 's' => 2.15, ],
            'headline' => ['l' => 48, 'r' => 336, 'y' => 253, 'c' => "asset", 'sc' => "black", 's' => 2.6, ],
            'bodyText' => ['position' => 'below', 'p' => 15, 'l' => 48, 'r' => 90, 'c' => "black", 's' => 2.4, ],
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
