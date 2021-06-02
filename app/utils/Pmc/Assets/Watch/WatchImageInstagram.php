<?php


namespace App\utils\Pmc\Assets\Watch;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class WatchImageInstagram extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617451534/pmc/assets/ufmyl9fw9erg6ifsfwlr.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/ufmyl9fw9erg6ifsfwlr";
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
            'logo' => ['x' => 49, 'y' => 474, 'w' => 251, 'h' => 100, ],
            'cta' => ['l' => 65, 'r' => 495, 'y' => 985, 'h' => 50, 'c' => 'white', 's' => 2.2, ],
            'headline' => ['l' => 49, 'r' => 122, 'y' => 610, 'c' => "black", 'sc' => "asset", 's' => 2.2, ],
            'bodyText' => ['position' => 'below', 'p' => 12, 'l' => 49, 'r' => 35, 'c' => "black", 's' => 2, 'lh' => 1.2, ],
            'overlay' => [
                'x' => 0, 'y' => 0, 'w' => 1080, 'h' => 431,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617451674/pmc/assets/okidphvtw6v8a7cvnbwz.png',
                'public_id' => 'pmc:assets:okidphvtw6v8a7cvnbwz',
            ],
        ];
    }
}
