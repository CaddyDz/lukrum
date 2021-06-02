<?php


namespace App\utils\Pmc\Assets\Cib;

use App\utils\Pmc\Assets\ImageDataSourceCibBanner;

class CibImageMobile extends \App\utils\Pmc\Assets\AssetImageCibAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619446157/pmc/assets/qypz3pltgrm28zkvjpeh.png";
    }

    protected $sourceClass = ImageDataSourceCibBanner::class;

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/qypz3pltgrm28zkvjpeh";
    }

    public function GetBaseColor(): string {
        return "#XXXXXX";
    }

    public function params()
    {
        return [
            'size' => ['w' => 320, 'h' => 50, ],
            'logo' => ['x' => 48, 'y' => 18, 'w' => 38, 'h' => 14, 'a' => 'left', ],
            'cta' => ['l' => 120, 'r' => 108, 'y' => 34, 'h' => 30, 'c' => 'white', 's' => 0.40, ],
            'headline' => ['l' => 28, 'r' => 18, 'y' => 204, 'c' => "#225793", 'sc' => "#5392c5", 's' => 0.95, ],
            'bodyText' => ['position' => 'none', 'p' => 12, 'l' => 28, 'r' => 20, 'c' => "#0f2d5d", 'ff'=>'sans-serif', 's' => 0.85],
        ];
    }
}
