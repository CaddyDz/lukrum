<?php


namespace App\utils\Pmc\Assets\Blue;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class BlueImageLeaderBoard extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619118835/pmc/assets/yvm6m7inwiqb8iijy17k.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/yvm6m7inwiqb8iijy17k";
    }

    public function GetBaseColor(): string {
        return "#459CD5";
    }

    public function params()
    {
        return [
            'size' => ['w' => 728, 'h' => 90, ],
            'logo' => ['x' => 18, 'y' => 16, 'w' => 67, 'h' => 29, ],
            'cta' => ['l' => 575, 'r' => 39, 'y' => 39, 'h' => 30, 'c' => 'white', 's' => 0.625, ],
            'headline' => ['l' => 17, 'r' => 248, 'y' => 50 , 'c' => "black", 'sc' => "black", 's' => 0.5291358025, ],
            'bodyText' => ['position' => 'none', 'p' => 3, 'l' => 40, 'r' => 30, 'c' => "black", 's' => 0.6438888889, ],
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
