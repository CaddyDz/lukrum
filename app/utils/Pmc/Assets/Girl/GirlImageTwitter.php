<?php


namespace App\utils\Pmc\Assets\Girl;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class GirlImageTwitter extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617452002/pmc/assets/fkkf78zg0c4y3ugylf0c.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/fkkf78zg0c4y3ugylf0c";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {

        // 0.33333333
        // 3.24 - 27 - 1.20
        // 1.35 - 0.47 - 0.78
        // 1.37 - - 1.95

        return [
            'size' => ['w' => 900, 'h' => 450, ],
            'logo' => ['x' => 53, 'y' => 45, 'w' => 147, 'h' => 60, ],
            'cta' => ['l' => 503, 'r' => 47, 'y' => 383, 'h' => 40, 'c' => 'white', 's' => 1.4, ],
            'headline' => ['l' => 53, 'r' => 528, 'y' => 140, 'c' => "asset", 'sc' => "black", 's' => 1.3, ],
            'bodyText' => ['position' => 'none', 'p' => 30, 'l' => 53, 'r' => 506, 'c' => "black", 's' => 0.51/*0.4125000041*/, 'ff' => 'sans-serif', 'lh' => 1.5, ],
            'overlay' => [
                'x' => 431, 'y' => 0, 'w' => 469, 'h' => 450,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617452079/pmc/assets/ny0ajclwppvjvraemivo.png',
                'public_id' => 'pmc:assets:ny0ajclwppvjvraemivo',

                'layer2' => [
                    'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617452871/pmc/assets/xpu41gqpxaa5esnotnp0.png',
                    'public_id' => 'pmc:assets:xpu41gqpxaa5esnotnp0',
                ],
            ],

        ];
    }
}
