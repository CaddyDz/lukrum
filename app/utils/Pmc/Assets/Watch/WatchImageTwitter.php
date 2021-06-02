<?php


namespace App\utils\Pmc\Assets\Watch;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class WatchImageTwitter extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617451505/pmc/assets/gzks6yu1knqclqjybf2e.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/gzks6yu1knqclqjybf2e";
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
            'logo' => ['x' => 29, 'y' => 47, 'w' => 162, 'h' => 67, ],
            'cta' => ['l' => 37, 'r' => 558, 'y' => 388, 'h' => 25, 'c' => 'white', 's' => 1.3125000131, ],
            'headline' => ['l' => 29, 'r' => 451, 'y' => 136, 'c' => "black", 'sc' => "asset", 's' => 1.0, ],
            'bodyText' => ['position' => 'below', 'p' => 15, 'l' => 29, 'r' => 471, 'c' => "black", 's' => 1.4, ],
            'overlay' => [
                'x' => 490, 'y' => 0, 'w' => 410, 'h' => 450,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617451649/pmc/assets/ghfikvmrya6h6cdlwxpy.png',
                'public_id' => 'pmc:assets:ghfikvmrya6h6cdlwxpy',
            ],
        ];
    }
}
