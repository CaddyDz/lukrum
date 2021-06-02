<?php


namespace App\utils\Pmc\Assets\Watch;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class WatchImageLargeRectangle extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1616410126/pmc/assets/kljjn8fww5s7ydfzmdsy.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/kljjn8fww5s7ydfzmdsy";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        return [
            'size' => ['w' => 300, 'h' => 600, ],
            'logo' => ['x' => 20, 'y' => 255, 'w' => 125, 'h' => 50, ],
            'cta' => ['l' => 60, 'r' => 60, 'y' => 561, 'h' => 25, 'c' => 'white', 's' => 0.8, ],
            'headline' => ['l' => 28, 'r' => 18, 'y' => 328, 'c' => "black", 'sc' => "asset", 's' => 0.69, ],
            'bodyText' => ['position' => 'below', 'p' => 15, 'l' => 28, 'r' => 18, 'c' => "black", 's' => 0.6222222222, ],
            'overlay' => [
                'x' => 0, 'y' => 0, 'w' => 300, 'h' => 236,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1616409286/pmc/assets/cxkqesllv3olgijo91q9.png',
                'public_id' => 'pmc:assets:cxkqesllv3olgijo91q9',
            ],
        ];
    }
}
