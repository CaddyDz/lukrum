<?php


namespace App\utils\Pmc\Assets\Cib;

use App\utils\Pmc\Assets\ImageDataSourceCibSocialMedia;

class CibImageTwitter extends \App\utils\Pmc\Assets\AssetImageCibAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceCibSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619456258/pmc/assets/x7byzqpvqxwxi6xyrhks.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/x7byzqpvqxwxi6xyrhks";
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
            'size' => ['w' => 900, 'h' => 450, ],
            'logo' => ['x' => 178, 'y' => 28, 'w' => 142, 'h' => 49, ],
            'logo2' => ['x' => 654, 'y' => 188, 'w' => 158, 'h' => 53, ],
            'cta' => ['l' => 97, 'r' => 443, 'y' => 358, 'h' => 40, 'c' => 'white', 's' => 1.5, ],
            'headline' => ['l' => 86, 'r' => 30, 'y' => 245, 'c' => "asset", 'sc' => "black", 's' => 1.8, ],
            'bodyText' => ['position' => 'below', 'p' => 0, 'l' => 94, 'r' => 350, 'c' => "#0f2d5d", 'ff'=>'sans-serif', 's' => 1, 'lh' => 1.2, ],
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
