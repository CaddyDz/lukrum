<?php


namespace App\utils\Pmc\Assets\Girl;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class GirlImageLanding extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1618506849/pmc/assets/mquluhahuz8shhljijhi.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/mquluhahuz8shhljijhi";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        // 0.26223776223776224
        // 3.24 - 1.44 - 1.20
        // 1.48 - 0.68 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 2048, 'h' => 2288, ],
            'logo' => ['x' => 128, 'y' => 140, 'w' => 279, 'h' => 117, ],
            'cta' => ['l' => 1260, 'r' => 160, 'y' => 1900, 'h' => 60, 'c' => 'white', 's' => 1.75, 'ff' => 'times', ],
            'headline' => ['l' => 129, 'r' => 880, 'y' => 367, 'c' => "asset", 's' => 1.75,],
            'intro' => ['l' => 129, 'r' => 880, 'y' => 690, 'c' => "black", 's' => 0.9, ],
            'bodyText' => ['position' => 'absolute', 'p' => 0, 'y' => 918, 'l' => 129, 'r' => 995, 'c' => "black", 's' => 1.5, 'lh' => 1.2, ],

            'overlay' => [
                'x' => 0, 'y' => 1302, 'w' => 1144, 'h' => 986,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1618506872/pmc/assets/ifreslntxr3qvmt2zjlt.png',
                'public_id' => 'pmc:assets:ifreslntxr3qvmt2zjlt',

//                'layer2' => [
//                    'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617452871/pmc/assets/xpu41gqpxaa5esnotnp0.png',
//                    'public_id' => 'pmc:assets:xpu41gqpxaa5esnotnp0',
//                ],
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
