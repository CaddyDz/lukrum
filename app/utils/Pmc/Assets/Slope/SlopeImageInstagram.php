<?php


namespace App\utils\Pmc\Assets\Slope;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class SlopeImageInstagram extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617795442/pmc/assets/u17kvn2caz9mnd8aubrr.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/u17kvn2caz9mnd8aubrr";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        // 0.37037037037037035
        // 3.24 - 27 - 1.20
        // 1.5 - 0.68 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 1080, 'h' => 1080, ],
            'logo' => ['x' => 54, 'y' => 63, 'w' => 271, 'h' => 116, ],
            'cta' => ['l' => 72, 'r' => 350, 'y' => 940, 'h' => 50, 'c' => 'asset', 's' => 2.485, ],
            'headline' => ['l' => 54, 'r' => 105, 'y' => 268, 'c' => "white", 'sc' => "black", 's' => 2.6, ],
            'bodyText' => ['position' => 'below', 'p' => 15, 'l' => 54, 'r' => 84, 'c' => "black", 's' => 2.6, 'lh' => 1.2, ],
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
