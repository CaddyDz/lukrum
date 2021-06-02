<?php


namespace App\utils\Pmc\Assets\Watch;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class WatchImageFacebook extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617451484/pmc/assets/r688kj8ph7nelovshcfe.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/r688kj8ph7nelovshcfe";
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
            'logo' => ['x' => 39, 'y' => 56, 'w' => 220, 'h' => 89, ],
            'cta' => ['l' => 55, 'r' => 634, 'y' => 531, 'h' => 25, 'c' => 'white', 's' => 1.85, ],
            'headline' => ['l' => 39, 'r' => 584, 'y' => 182, 'c' => "black", 'sc' => "asset", 's' => 1.25, ],
            'bodyText' => ['position' => 'below', 'p' => 15, 'l' => 39, 'r' => 590, 'c' => "black", 's' => 1.8, 'lh' => 1.2, ],
            'overlay' => [
                'x' => 640, 'y' => 0, 'w' => 560, 'h' => 630,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617451632/pmc/assets/jczysj029yyohptdigou.png',
                'public_id' => 'pmc:assets:jczysj029yyohptdigou',
            ],
        ];
    }
}
