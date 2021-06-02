<?php


namespace App\utils\Pmc\Assets\Simple;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class SimpleImageLeaderBoard extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619701280/pmc/assets/zmdrtuwsqypddno2zgwn.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/zmdrtuwsqypddno2zgwn";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        return [
            'size' => ['w' => 728, 'h' => 90, ],
            'logo' => ['x' => 21, 'y' => 19, 'w' => 90, 'h' => 37, ],
            'cta' => ['l' => 552, 'r' => 28, 'y' => 47, 'h' => 30, 'c' => 'white', 's' => 0.685, ],
            'headline' => ['l' => 205, 'r' => 230, 'y' => 12, 'c' => "asset", 'sc' => "black", 's' => 0.5691358025, ],
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
