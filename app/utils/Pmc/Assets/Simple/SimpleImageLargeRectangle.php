<?php


namespace App\utils\Pmc\Assets\Simple;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class SimpleImageLargeRectangle extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;


    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619701162/pmc/assets/tss7envkyotu0llihp0j.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/tss7envkyotu0llihp0j";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        return [
            'size' => ['w' => 300, 'h' => 600, ],
            'logo' => ['x' => 20, 'y' => 20, 'w' => 168, 'h' => 68, ],
            'cta' => ['l' => 24, 'r' => 24, 'y' => 548, 'h' => 30, 'c' => 'white', ],
            'headline' => ['l' => 32, 'r' => 18, 'y' => 147, 'c' => "asset", 'sc' => "black", 's' => 0.95, ],
            'bodyText' => ['position' => 'below', 'p' => 16, 'l' => 32, 'r' => 24, 'c' => "black", ],
        ];
    }
}
