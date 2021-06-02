<?php


namespace App\utils\Pmc\Assets\Blue;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class BlueImageLargeRectangle extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619118607/pmc/assets/nz6wrpsy2wqjawj3e8ua.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/nz6wrpsy2wqjawj3e8ua";
    }

    public function GetBaseColor(): string {
        return "#459CD5";
    }

    public function params()
    {
        return [
            'size' => ['w' => 300, 'h' => 600, ],
            'logo' => ['x' => 20, 'y' => 26, 'w' => 260, 'h' => 51, ],
            'cta' => ['l' => 24, 'r' => 24, 'y' => 560, 'h' => 30, 'c' => 'white', 's' => 0.95, ],
            'headline' => ['l' => 18, 'r' => 28, 'y' => 188, 'c' => "black", 'sc' => "black", 's' => 0.69, ],
            'bodyText' => ['position' => 'below', 'p' => 10, 'l' => 18, 'r' => 28, 'c' => "white", 's' => 0.6851851852, 'ff' => 'sans-serif', ],

            'overlay' => [
                'x' => 16, 'y' => 83, 'w' => 269, 'h' => 68,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617433154/pmc/assets/kg8x7ocaxip1bqb7ckup.png',
                'public_id' => 'pmc:assets:kg8x7ocaxip1bqb7ckup',
            ],
        ];
    }
}
