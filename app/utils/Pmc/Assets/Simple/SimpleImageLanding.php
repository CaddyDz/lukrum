<?php


namespace App\utils\Pmc\Assets\Simple;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class SimpleImageLanding extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619701445/pmc/assets/fkore99zz5b4hrsdotpn.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/fkore99zz5b4hrsdotpn";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        // 0.26223776223776224
        // 3.24 - 1.44 - 1.20
        // 1.48 - 0.68 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 2048, 'h' => 2288, ],
            'logo' => ['x' => 136, 'y' => 110, 'w' => 302, 'h' => 124, ],
            'cta' => ['l' => 1260, 'r' => 160, 'y' => 1985, 'h' => 60, 'c' => 'white', 's' => 1.75, 'ff' => 'times', ],
            'headline' => ['l' => 129, 'r' => 880, 'y' => 450, 'c' => "asset", 's' => 1.75,],
            'intro' => ['l' => 129, 'r' => 880, 'y' => 765, 'c' => "black", 's' => 1.1, ],
            'bodyText' => ['position' => 'absolute', 'p' => 0, 'y' => 1100, 'l' => 129, 'r' => 995, 'c' => "black", 's' => 2.5, 'lh' => 1.2, ],
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
