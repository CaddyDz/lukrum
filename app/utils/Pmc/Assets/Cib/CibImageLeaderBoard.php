<?php


namespace App\utils\Pmc\Assets\Cib;

use App\utils\Pmc\Assets\ImageDataSourceCibBanner;

class CibImageLeaderBoard extends \App\utils\Pmc\Assets\AssetImageCibAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619446120/pmc/assets/hx1xdz3pu56ldfhwtqbx.png";
    }

    protected $sourceClass = ImageDataSourceCibBanner::class;

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/hx1xdz3pu56ldfhwtqbx";
    }

    public function GetBaseColor(): string {
        return "#XXXXXX";
    }

    public function params()
    {
        return [
            'size' => ['w' => 728, 'h' => 90, ],
            'logo' => ['x' => 89, 'y' => 27, 'w' => 79, 'h' => 29, 'a' => 'left', ],
            'cta' => ['l' => 550, 'r' => 22, 'y' => 44, 'h' => 30, 'c' => 'white', 's' => 0.65],
            'headline' => ['l' => 28, 'r' => 18, 'y' => 58, 'c' => "#225793", 'sc' => "#5392c5", 's' => 0.95, ],
            'bodyText' => ['position' => 'below', 'p' => 2, 'l' => 213, 'r' => 188, 'c' => "#0f2d5d", 'ff'=>'sans-serif', 's' => 0.48],
        ];
    }
}
