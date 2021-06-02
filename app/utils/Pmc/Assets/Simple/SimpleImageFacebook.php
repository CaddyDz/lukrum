<?php


namespace App\utils\Pmc\Assets\Simple;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class SimpleImageFacebook extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619701598/pmc/assets/jl81vngvpv9zezjr0er2.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/jl81vngvpv9zezjr0er2";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        // 0.33333333
        // 3.24 - 1.44 - 1.20
        // 1.48 - 0.68 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 1200, 'h' => 630, ],
            'logo' => ['x' => 44, 'y' => 48, 'w' => 188, 'h' => 74, ],
            'cta' => ['l' => 65, 'r' => 695, 'y' => 537, 'h' => 40, 'c' => 'white', 's' => 1.75, ],
            'headline' => ['l' => 47, 'r' => 30, 'y' => 180, 'c' => "asset", 'sc' => "black", 's' => 2.0, ],
            'bodyText' => ['position' => 'below', 'p' => 10, 'l' => 47, 'r' => 40, 'c' => "black", 's' => 2.15, 'lh' => 1.2, ],
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
