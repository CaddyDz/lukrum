<?php


namespace App\utils\Pmc\Assets\Girl;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class GirlImageMobile extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617296255/pmc/assets/ra8w6imw55pdvlxca123.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/ra8w6imw55pdvlxca123";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        return [
            'size' => ['w' => 320, 'h' => 50, ],
            'logo' => ['x' => 12, 'y' => 7, 'w' => 34, 'h' => 14, ],
            'cta' => ['l' => 238, 'r' => 10, 'y' => 35, 'h' => 30, 'c' => 'white', 's' => 0.35, ],
            'headline' => ['l' => 12, 'r' => 210, 'y' => 24, 'c' => "asset", 'sc' => "black", 's' => 0.1777777778, ],
            'bodyText' => ['position' => 'none', 'p' => 3, 'l' => 40, 'r' => 30, 'c' => "black", 's' => 0.6438888889, ],
            'overlay' => [
                'x' => 141, 'y' => 0, 'w' => 179, 'h' => 50,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1616685983/pmc/assets/mwvsep2usmppkmck6dsa.png',
                'public_id' => 'pmc:assets:mwvsep2usmppkmck6dsa',

                'layer2' => [
                    'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617296432/pmc/assets/ejocf1zevls6lhe1g4pu.png',
                    'public_id' => 'pmc:assets:ejocf1zevls6lhe1g4pu',
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
