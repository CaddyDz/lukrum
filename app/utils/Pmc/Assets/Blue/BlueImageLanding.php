<?php


namespace App\utils\Pmc\Assets\Blue;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class BlueImageLanding extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619119119/pmc/assets/kvtr0uzsixjyxrn5qh7x.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/kvtr0uzsixjyxrn5qh7x";
    }

    public function GetBaseColor(): string {
        return "#459CD5";
    }

    public function params()
    {
        // 0.26223776223776224
        // 3.24 - 1.44 - 1.20
        // 1.48 - 0.68 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 2048, 'h' => 2288, ],
            'logo' => ['x' => 162, 'y' => 187, 'w' => 302, 'h' => 134, ],
            'cta' => ['l' => 1190, 'r' => 235, 'y' => 2085, 'h' => 60, 'c' => 'white', 's' => 1.75, 'ff' => 'times', ],
            'headline' => ['l' => 140, 'r' => 1050, 'y' => 613, 'c' => "asset", 's' => 2.2,],
            'intro' => ['l' => 140, 'r' => 1050, 'y' => 1248, 'c' => "black", 's' => 1.1, ],
            'bodyText' => ['position' => 'absolute', 'p' => 0, 'y' => 1490, 'l' => 140, 'r' => 1050, 'c' => "black", 's' => 1.2, 'lh' => 1.2, ],

            'overlay' => [
                'x' => 771, 'y' => 88, 'w' => 1090, 'h' => 283,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617433154/pmc/assets/kg8x7ocaxip1bqb7ckup.png',
                'public_id' => 'pmc:assets:kg8x7ocaxip1bqb7ckup',
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
