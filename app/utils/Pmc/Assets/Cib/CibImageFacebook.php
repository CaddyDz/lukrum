<?php


namespace App\utils\Pmc\Assets\Cib;

use App\utils\Pmc\Assets\ImageDataSourceCibSocialMedia;

class CibImageFacebook extends \App\utils\Pmc\Assets\AssetImageCibAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceCibSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1618150701/pmc/assets/nurhiqqvrw2blclfv6qb.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/nurhiqqvrw2blclfv6qb";
    }

    public function GetBaseColor(): string {
        return "#XXXXXX";
    }

    public function params()
    {
        // 0.33333333
        // 3.24 - 1.44 - 1.20
        // 1.48 - 0.68 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 1200, 'h' => 630, ],
            'logo' => ['x' => 264, 'y' => 36, 'w' => 208, 'h' => 69, ],
            'logo2' => ['x' => 865, 'y' => 258, 'w' => 217, 'h' => 80, ],
            'cta' => ['l' => 88, 'r' => 615, 'y' => 489, 'h' => 40, 'c' => 'white', 's' => 1.75, ],
            'headline' => ['l' => 86, 'r' => 30, 'y' => 325, 'c' => "asset", 'sc' => "black", 's' => 1.8, ],
            'bodyText' => ['position' => 'below', 'p' => 0, 'l' => 86, 'r' => 518, 'c' => "#0f2d5d", 'ff'=>'sans-serif', 's' => 1.6, 'lh' => 1.2, ],
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
