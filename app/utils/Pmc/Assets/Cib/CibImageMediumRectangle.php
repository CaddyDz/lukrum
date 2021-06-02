<?php


namespace App\utils\Pmc\Assets\Cib;

use App\utils\Pmc\Assets\ImageDataSourceCibBanner;

class CibImageMediumRectangle extends \App\utils\Pmc\Assets\AssetImageCibAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619446140/pmc/assets/bvc2npp9d1wmg325w1pj.png";
    }

    protected $sourceClass = ImageDataSourceCibBanner::class;

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/bvc2npp9d1wmg325w1pj";
    }

    public function GetBaseColor(): string {
        return "#XXXXXX";
    }

    public function params()
    {
        return [
            'size' => ['w' => 300, 'h' => 250, ],
            'logo' => ['x' => 94, 'y' => 18, 'w' => 82, 'h' => 29, 'a' => 'left', ],
            'cta' => ['l' => 25, 'r' => 77, 'y' => 215, 'h' => 30, 'c' => 'white', 's' => 0.78],
            'headline' => ['l' => 25, 'r' => 18, 'y' => 150, 'c' => "#225793", 'sc' => "#5392c5", 's' => 0.95, ],
            'bodyText' => ['position' => 'below', 'p' => 4, 'l' => 25, 'r' => 75, 'c' => "#0f2d5d", 'ff'=>'sans-serif', 's' => 0.5],
        ];
    }
}
