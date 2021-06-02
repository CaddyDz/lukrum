<?php


namespace App\utils\Pmc\Assets\Blue;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class BlueImageMediumRectangle extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619118774/pmc/assets/tkxjyky4vmofemiayqfp.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/tkxjyky4vmofemiayqfp";
    }

    public function GetBaseColor(): string {
        return "#459CD5";
    }

    public function params()
    {
        return [
            'size' => ['w' => 300, 'h' => 250, ],
            'logo' => ['x' => 16, 'y' => 20, 'w' => 90, 'h' => 37, ],
            'cta' => ['l' => 25, 'r' => 142, 'y' => 212, 'h' => 30, 'c' => 'white', 's' => 0.725, ],
            'headline' => ['l' => 17, 'r' => 85, 'y' => 75, 'c' => "black", 'sc' => "black", 's' => 0.5231481481, ],
            'bodyText' => ['position' => 'none', 'p' => 3, 'l' => 40, 'r' => 30, 'c' => "white", 's' => 0.6638888889, 'ff' => 'sans-serif', ],

            'overlay' => [
                'x' => 123, 'y' => 12, 'w' => 165, 'h' => 42,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1619118686/pmc/assets/kg8x7ocaxip1bqb7ckup.png',
                'public_id' => 'pmc:assets:kg8x7ocaxip1bqb7ckup',
            ],

        ];
    }
}
