<?php


namespace App\utils\Pmc\Assets\Simple;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class SimpleImageMediumRectangle extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1616593229/pmc/assets/y9t8aeyodqdorcfajdit.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/y9t8aeyodqdorcfajdit";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        return [
            'size' => ['w' => 300, 'h' => 250, ],
            'logo' => ['x' => 38, 'y' => 20, 'w' => 100, 'h' => 42, ],
            'cta' => ['l' => 18, 'r' => 18, 'y' => 214, 'h' => 30, 'c' => 'white', 's' => 0.725, ],
            'headline' => ['l' => 40, 'r' => 20, 'y' => 73, 'c' => "asset", 'sc' => "black", 's' => 0.4666666667, ],
            'bodyText' => ['position' => 'below', 'p' => 3, 'l' => 40, 'r' => 30, 'c' => "black", 's' => 0.5740740741, ],
        ];
//        return [
//            'size' => ['w' => 300, 'h' => 600, ],
//            'logo' => ['x' => 20, 'y' => 20, 'w' => 168, 'h' => 68, ],
//            'cta' => ['l' => 24, 'r' => 24, 'y' => 542, 'h' => 30, 'c' => 'asset', ],
//            'headline' => ['l' => 28, 'r' => 18, 'y' => 150, 'c' => "white", 'sc' => "black", ],
//            'bodyText' => ['position' => 'below', 'p' => 15, 'l' => 28, 'r' => 18, 'c' => "white", ],
//        ];
    }
}
