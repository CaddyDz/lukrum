<?php


namespace App\utils\Pmc\Assets\Watch;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class WatchImageMobile extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1616596184/pmc/assets/qy8tuoyhl2y2p08u2rwd.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/qy8tuoyhl2y2p08u2rwd";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        return [
            'size' => ['w' => 320, 'h' => 50, ],
            'logo' => ['x' => 124, 'y' => 8, 'w' => 30, 'h' => 14, ],
            'cta' => ['l' => 238, 'r' => 10, 'y' => 25, 'h' => 30, 'c' => 'white', 's' => 0.35, ],
            'headline' => ['l' => 124, 'r' => 94, 'y' => 24, 'c' => "asset", 'sc' => "black", 's' => 0.1786419753, ],
            'bodyText' => ['position' => 'none', 'p' => 3, 'l' => 40, 'r' => 30, 'c' => "black", 's' => 0.6438888889, ],
            'overlay' => [
                'x' => 0, 'y' => 0, 'w' => 113, 'h' => 50,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1616409286/pmc/assets/kywzxbzzru8mtlyrmype.png',
                'public_id' => 'pmc:assets:kywzxbzzru8mtlyrmype',
            ],
        ];
//
//        return [
//            'size' => ['w' => 300, 'h' => 600, ],
//            'logo' => ['x' => 20, 'y' => 20, 'w' => 168, 'h' => 68, ],
//            'cta' => ['l' => 24, 'r' => 24, 'y' => 542, 'h' => 30, 'c' => 'asset', ],
//            'headline' => ['l' => 28, 'r' => 18, 'y' => 150, 'c' => "white", 'sc' => "black", ],
//            'bodyText' => ['position' => 'below', 'p' => 15, 'l' => 28, 'r' => 18, 'c' => "white", ],
//        ];
    }
}
