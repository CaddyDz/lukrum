<?php


namespace App\utils\Pmc\Assets\Slope;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class SlopeImageLargeRectangle extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1616321713/pmc/assets/ausy9ouzfkgof78phvl2.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/ausy9ouzfkgof78phvl2";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        return [
            'size' => ['w' => 300, 'h' => 600, ],
            'logo' => ['x' => 20, 'y' => 20, 'w' => 168, 'h' => 68, ],
            'cta' => ['l' => 24, 'r' => 24, 'y' => 549, 'h' => 30, 'c' => 'asset', 's' => 1, ],
            'headline' => ['l' => 32, 'r' => 18, 'y' => 156, 'c' => "white", 'sc' => "black", 's' => 1, ],
            'bodyText' => ['position' => 'below', 'p' => 15, 'l' => 32, 'r' => 36, 'c' => "white", 's' => 0.95, ],
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
