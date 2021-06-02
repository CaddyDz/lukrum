<?php


namespace App\utils\Pmc\Instances\Demo\Layouts\CibDemo;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class CibDemoImageLanding extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1620816142/demo/pmc/assets/sgrqpe1pk6locdthtuth.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "demo/pmc/assets/sgrqpe1pk6locdthtuth";
    }

    public function GetBaseColor(): string {
        return "#XXXXXX";
    }

    public function params()
    {
        // 0.26223776223776224
        // 3.24 - 1.44 - 1.20
        // 1.48 - 0.68 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 2048, 'h' => 2288, ],
            'logo' => ['x' => 215, 'y' => 54, 'w' => 330, 'h' => 142, ],
//            'logo2' => ['x' => 411, 'y' => 1595, 'w' => 470, 'h' => 150, ],
            'cta' => ['l' => 1260, 'r' => 165, 'y' => 2151, 'h' => 60, 'c' => 'white', 's' => 1.75, ],
            'headline' => ['l' => 214, 'r' => 120, 'y' => 510, 'c' => "#0f2d5d", 's' => 1, 'ff'=>'sans-serif',],
            'intro' => ['l' => 214, 'r' => 885, 'y' => 650, 'c' => "#0f2d5d", 's' => 1, 'ff'=>'sans-serif', ],
            'bodyText' => ['position' => 'absolute', 'p' => 0, 'y' => 850, 'l' => 214, 'r' => 900, 'c' => "#0f2d5d", 'ff'=>'sans-serif', 's' => 1, 'lh' => 1.2, ],
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
