<?php


namespace App\utils\Pmc\Assets\Girl;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class GirlImageSkyScrapper extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617291376/pmc/assets/wrhjfdijjseuagdzn5nb.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/wrhjfdijjseuagdzn5nb";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        return [
            'size' => ['w' => 120, 'h' => 600, ],
            'logo' => ['x' => 7, 'y' => 44, 'w' => 106, 'h' => 44, ],
            'cta' => ['l' => 9, 'r' => 9, 'y' => 568, 'h' => 30, 'c' => 'white', 's' => 0.625, ],
            'headline' => ['l' => 10, 'r' => 10, 'y' => 120, 'c' => "asset", 'sc' => "black", 's' => 0.4166666667, ],
            'bodyText' => ['position' => 'below', 'p' => 13, 'l' => 10, 'r' => 13, 'c' => "black", 's' => 0.6111111111, ],
            'overlay' => [
                'x' => 0, 'y' => 369, 'w' => 120, 'h' => 231,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1616685912/pmc/assets/x2suih34zo6w4u5zh6hg.png',
                'public_id' => 'pmc:assets:x2suih34zo6w4u5zh6hg',

                'layer2' => [
                    'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617291446/pmc/assets/b05pjrlscy0cslrxmu2u.png',
                    'public_id' => 'pmc:assets:b05pjrlscy0cslrxmu2u',
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
