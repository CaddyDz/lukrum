<?php


namespace App\utils\Pmc\Assets\Girl;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class GirlImageLeaderBoard extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617296307/pmc/assets/jxudoa7e724amljeoawo.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/jxudoa7e724amljeoawo";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        return [
            'size' => ['w' => 728, 'h' => 90, ],
            'logo' => ['x' => 15, 'y' => 19, 'w' => 65, 'h' => 28, ],
            'cta' => ['l' => 547, 'r' => 14, 'y' => 62, 'h' => 30, 'c' => 'white', 's' => 0.685, ],
            'headline' => ['l' => 16, 'r' => 308, 'y' => 54, 'c' => "asset", 'sc' => "black", 's' => 0.4320987654, ],
            'bodyText' => ['position' => 'none', 'p' => 3, 'l' => 40, 'r' => 30, 'c' => "black", 's' => 0.6438888889, ],
            'overlay' => [
                'x' => 434, 'y' => 0, 'w' => 294, 'h' => 90,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1616686023/pmc/assets/k7caote06i79tmiipmow.png',
                'public_id' => 'pmc:assets:k7caote06i79tmiipmow',

                'layer2' => [
                    'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617296471/pmc/assets/xdyfdxxx3smrhyrnm9jy.png',
                    'public_id' => 'pmc:assets:xdyfdxxx3smrhyrnm9jy',
                ],
            ],
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
