<?php


namespace App\utils\Pmc\Assets\Girl;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class GirlImageFacebook extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617451984/pmc/assets/vbfq5xtajgwbkwtzynsp.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/vbfq5xtajgwbkwtzynsp";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {

        // 0.33333333
        // 3.24 - 1.44 - 1.20
        // 1.35 - 0.47 - 0.78
        // 1.37 - - 1.95

        return [
            'size' => ['w' => 1200, 'h' => 630, ],
            'logo' => ['x' => 76, 'y' => 64, 'w' => 206, 'h' => 86, ],
            'cta' => ['l' => 695, 'r' => 60, 'y' => 544, 'h' => 40, 'c' => 'white', 's' => 1.75, ],
            'headline' => ['l' => 76, 'r' => 681, 'y' => 200, 'c' => "asset", 'sc' => "black", 's' => 1.7, ],
            'bodyText' => ['position' => 'below', 'p' => 12, 'l' => 76, 'r' => 681, 'c' => "black", 's' => 0.7055555556 /*0.6555555556*/, 'ff' => 'sans-serif', ],

            'overlay' => [
                'x' => 569, 'y' => 0, 'w' => 631, 'h' => 630,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617452059/pmc/assets/l6qxrd4bcezwwc4ccojh.png',
                'public_id' => 'pmc:assets:l6qxrd4bcezwwc4ccojh',

                'layer2' => [
                    'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617452856/pmc/assets/wopbrtrxeyotzhem0wri.png',
                    'public_id' => 'pmc:assets:wopbrtrxeyotzhem0wri',
                ],
            ],

        ];
    }
}
