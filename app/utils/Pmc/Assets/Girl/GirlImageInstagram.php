<?php


namespace App\utils\Pmc\Assets\Girl;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class GirlImageInstagram extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617452020/pmc/assets/ucuh5gnjft3hvhjtl3sv.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/ucuh5gnjft3hvhjtl3sv";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {

        // 0.37037037037037035
        // 3.24 - 27 - 1.20
        // 1.35 - 0.47 - 0.78
        // 1.37 - - 1.95

        return [
            'size' => ['w' => 1080, 'h' => 1080, ],
            'logo' => ['x' => 50, 'y' => 87, 'w' => 248, 'h' => 101, ],
            'cta' => ['l' => 257, 'r' => 267, 'y' => 984, 'h' => 50, 'c' => 'white', 's' => 2.2, ],
            'headline' => ['l' => 50, 'r' => 34, 'y' => 240, 'c' => "asset", 'sc' => "black", 's' => 1.8, ],
            'bodyText' => ['position' => 'none', 'p' => 30, 'l' => 50, 'r' => 36, 'c' => "black", 's' => 0.928 /*0.78*/, 'ff' => 'sans-serif', 'lh' => 1.5, ],
            'overlay' => [
                'x' => 0, 'y' => 481, 'w' => 1080, 'h' => 599,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617452133/pmc/assets/kjijw5lqjbgk1nhujd4r.png',
                'public_id' => 'pmc:assets:kjijw5lqjbgk1nhujd4r',

                'layer2' => [
                    'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617452888/pmc/assets/krcofe4iirvhz3wgcspx.png',
                    'public_id' => 'pmc:assets:krcofe4iirvhz3wgcspx',
                ],
            ],

        ];
    }
}
