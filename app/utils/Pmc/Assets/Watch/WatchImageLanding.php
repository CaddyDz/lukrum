<?php


namespace App\utils\Pmc\Assets\Watch;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class WatchImageLanding extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1618506053/pmc/assets/uddo8i7tfq4il16j7tzb.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/uddo8i7tfq4il16j7tzb";
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
            'logo' => ['x' => 125, 'y' => 595, 'w' => 268, 'h' => 113, ],
            'cta' => ['l' => 1260, 'r' => 160, 'y' => 2104, 'h' => 60, 'c' => 'white', 's' => 1.75, 'ff' => 'times', ],
            'headline' => ['l' => 125, 'r' => 880, 'y' => 787, 'c' => "asset", 's' => 1.75,],
            'intro' => ['l' => 125, 'r' => 880, 'y' => 1100, 'c' => "black", 's' => 1.1, ],
            'bodyText' => ['position' => 'absolute', 'p' => 0, 'y' => 1435, 'l' => 125, 'r' => 880, 'c' => "black", 's' => 2.5, 'lh' => 1.2, ],

            'overlay' => [
                'x' => 0, 'y' => 0, 'w' => 2048, 'h' => 474,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1618506084/pmc/assets/xschwb2zgetx3wrogegn.png',
                'public_id' => 'pmc:assets:xschwb2zgetx3wrogegn',
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
