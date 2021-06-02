<?php


namespace App\utils\Pmc\Assets\Slope;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class SlopeImageMobile extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1616596184/pmc/assets/usjkyhxqqjonh53xazsn.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/usjkyhxqqjonh53xazsn";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        return [
            'size' => ['w' => 320, 'h' => 50, ],
            'logo' => ['x' => 10, 'y' => 18, 'w' => 46, 'h' => 17, ],
            'cta' => ['l' => 238, 'r' => 10, 'y' => 24, 'h' => 30, 'c' => 'asset', 's' => 0.35, ],
            'headline' => ['l' => 94, 'r' => 94, 'y' => 10, 'c' => "white", 'sc' => "black", 's' => 0.2777777778, ],
            'bodyText' => ['position' => 'none', 'p' => 3, 'l' => 40, 'r' => 30, 'c' => "white", 's' => 0.6438888889, ],
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
