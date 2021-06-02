<?php


namespace App\utils\Pmc\Assets\Watch;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class WatchImageLeaderBoard extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1616598542/pmc/assets/b3xz45fn3tuh03vbhwbr.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/b3xz45fn3tuh03vbhwbr";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        return [
            'size' => ['w' => 728, 'h' => 90, ],
            'logo' => ['x' => 180, 'y' => 19, 'w' => 63, 'h' => 26, ],
            'cta' => ['l' => 552, 'r' => 13, 'y' => 42, 'h' => 30, 'c' => 'white', 's' => 0.685, ],
            'headline' => ['l' => 181, 'r' => 187, 'y' => 51, 'c' => "asset", 'sc' => "black", 's' => 0.4240740741, ],
            'bodyText' => ['position' => 'none', 'p' => 3, 'l' => 40, 'r' => 30, 'c' => "black", 's' => 0.6438888889, ],
            'overlay' => [
                'x' => 0, 'y' => 0, 'w' => 166, 'h' => 90,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1616409286/pmc/assets/yamsxgwy1sqsbz66y1zt.png',
                'public_id' => 'pmc:assets:yamsxgwy1sqsbz66y1zt',
            ],
        ];

        //yamsxgwy1sqsbz66y1zt
//        return [
//            'size' => ['w' => 300, 'h' => 600, ],
//            'logo' => ['x' => 20, 'y' => 20, 'w' => 168, 'h' => 68, ],
//            'cta' => ['l' => 24, 'r' => 24, 'y' => 542, 'h' => 30, 'c' => 'asset', ],
//            'headline' => ['l' => 28, 'r' => 18, 'y' => 150, 'c' => "white", 'sc' => "black", ],
//            'bodyText' => ['position' => 'below', 'p' => 15, 'l' => 28, 'r' => 18, 'c' => "white", ],
//        ];
    }
}
