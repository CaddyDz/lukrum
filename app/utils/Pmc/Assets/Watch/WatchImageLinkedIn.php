<?php


namespace App\utils\Pmc\Assets\Watch;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class WatchImageLinkedIn extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617451554/pmc/assets/luu7jysxxsqythnfztqr.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/luu7jysxxsqythnfztqr";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {

        // 0.25252525252525254
        // 3.24 - 27 - 1.20
        // 1.35 - 0.47 - 0.78
        // 1.37 - - 1.95

        return [
            'size' => ['w' => 1584, 'h' => 768, ],
            'logo' => ['x' => 51, 'y' => 65, 'w' => 266, 'h' => 104, ],
            'cta' => ['l' => 65, 'r' => 998, 'y' => 663, 'h' => 50, 'c' => 'white', 's' => 2.2, ],
            'headline' => ['l' => 51, 'r' => 755, 'y' => 220, 'c' => "black", 'sc' => "asset", 's' => 1.7, ],
            'bodyText' => ['position' => 'below', 'p' => 25, 'l' => 51, 'r' => 755, 'c' => "black", 's' => 2.6, 'lh' => 1.2, ],
            'overlay' => [
                'x' => 885, 'y' => 0, 'w' => 699, 'h' => 768,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617451692/pmc/assets/x8yn9seuzqz0rfwyovqz.png',
                'public_id' => 'pmc:assets:x8yn9seuzqz0rfwyovqz',
            ],
        ];
    }
}
