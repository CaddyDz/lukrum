<?php


namespace App\utils\Pmc\Assets\Cib;

use App\utils\Pmc\Assets\ImageDataSourceCibBanner;

class CibImageLargeRectangle extends \App\utils\Pmc\Assets\AssetImageCibAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1618150661/pmc/assets/ukad6lwhjq5gfn8u22go.png";
    }

    protected $sourceClass = ImageDataSourceCibBanner::class;

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/ukad6lwhjq5gfn8u22go";
    }

    public function GetBaseColor(): string {
        return "#XXXXXX";
    }

    public function params()
    {
        return [
            'size' => ['w' => 300, 'h' => 600, ],
            'logo' => ['x' => 146, 'y' => 17, 'w' => 97, 'h' => 35, 'a' => 'left', ],
            'logo2' => ['x' => 97, 'y' => 395, 'w' => 105, 'h' => 38, ],
            'cta' => ['l' => 22, 'r' => 22, 'y' => 556, 'h' => 30, 'c' => 'white', ],
            'headline' => ['l' => 28, 'r' => 18, 'y' => 204, 'c' => "#225793", 'sc' => "#5392c5", 's' => 0.95, ],
            'bodyText' => ['position' => 'below', 'p' => 12, 'l' => 28, 'r' => 20, 'c' => "#0f2d5d", 'ff'=>'sans-serif', 's' => 0.85],
        ];
    }
}
