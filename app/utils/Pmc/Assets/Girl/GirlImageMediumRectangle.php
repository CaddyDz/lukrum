<?php


namespace App\utils\Pmc\Assets\Girl;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class GirlImageMediumRectangle extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617296208/pmc/assets/myjpogs3oqvn3kcrmt2e.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/myjpogs3oqvn3kcrmt2e";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        return [
            'size' => ['w' => 300, 'h' => 250, ],
            'logo' => ['x' => 16, 'y' => 14, 'w' => 75, 'h' => 34, ],
            'cta' => ['l' => 18, 'r' => 18, 'y' => 212, 'h' => 30, 'c' => 'white', 's' => 0.725, ],
            'headline' => ['l' => 18, 'r' => 50, 'y' => 54, 'c' => "black", 'sc' => "asset", 's' => 0.4358024691, ],
            'bodyText' => ['position' => 'below', 'p' => 5, 'l' => 18, 'r' => 30, 'c' => "black", 's' => 0.4074074074, 'ff' => 'sans-serif', ],
            'overlay' => [
                'x' => 0, 'y' => 143, 'w' => 300, 'h' => 107,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1616685947/pmc/assets/jlydzga3ozob2mm50pqv.png',
                'public_id' => 'pmc:assets:jlydzga3ozob2mm50pqv',

                'layer2' => [
                    'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617296398/pmc/assets/aiogsark2nnlnveszxnx.png',
                    'public_id' => 'pmc:assets:aiogsark2nnlnveszxnx',
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
