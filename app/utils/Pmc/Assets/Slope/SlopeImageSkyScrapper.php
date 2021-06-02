<?php


namespace App\utils\Pmc\Assets\Slope;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class SlopeImageSkyScrapper extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1616588564/pmc/assets/ugibgvz18dnlundzeasq.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/ugibgvz18dnlundzeasq";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        return [
            'size' => ['w' => 120, 'h' => 600, ],
            'logo' => ['x' => 9, 'y' => 61, 'w' => 102, 'h' => 44, ],
            'cta' => ['l' => 9, 'r' => 9, 'y' => 569, 'h' => 30, 'c' => 'asset', 's' => 0.625, ],
            'headline' => ['l' => 10, 'r' => 10, 'y' => 195, 'c' => "white", 'sc' => "black", 's' => 0.4166666667, ],
            'bodyText' => ['position' => 'below', 'p' => 15, 'l' => 10, 'r' => 15, 'c' => "white", 's' => 0.634, ],
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
