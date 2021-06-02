<?php


namespace App\utils\Pmc\Assets\Watch;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class WatchImageMediumRectangle extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1616593229/pmc/assets/ohh9jdjddzutdrjfnoif.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/ohh9jdjddzutdrjfnoif";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        return [
            'size' => ['w' => 300, 'h' => 250, ],
            'logo' => ['x' => 30, 'y' => 19, 'w' => 100, 'h' => 42, ],
            'cta' => ['l' => 18, 'r' => 18, 'y' => 215, 'h' => 30, 'c' => 'white', 's' => 0.725, ],
            'headline' => ['l' => 19, 'r' => 52, 'y' => 87, 'c' => "black", 'sc' => "asset", 's' => 0.4266666667, ],
            'bodyText' => ['position' => 'below', 'p' => 3, 'l' => 19, 'r' => 46, 'c' => "black", 's' => 0.5555555556, ],
            'overlay' => [
                'x' => 150, 'y' => 0, 'w' => 150, 'h' => 125,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1616409286/pmc/assets/gmbetjsw4mzwlifpsou2.png',
                'public_id' => 'pmc:assets:gmbetjsw4mzwlifpsou2',

                'layer2' => [
                    'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617306995/pmc/assets/whfxngjoyakfw3hfvord.png',
                    'public_id' => 'pmc:assets:whfxngjoyakfw3hfvord',
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
