<?php


namespace App\utils\Pmc\Assets\Slope;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class SlopeImageOnePage extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1620212225/pmc/assets/tckptea3n2emxai9zbom.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/tckptea3n2emxai9zbom";
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
            'size' => ['w' => 612, 'h' => 792, ],
            'logo' => ['x' => 50, 'y' => 42, 'w' => 133, 'h' => 59, ],
            'cta' => ['l' => 45, 'r' => 32, 'y' => 666, 'h' => 40, 'c' => 'asset', 's' => 1.7, 'ff' => 'times', ],
            'headline' => ['l' => 45, 'r' => 35, 'y' => 160, 'c' => "asset", 's' => 0.75,],
            'intro' => ['l' => 45, 'r' => 35, 'y' => 270, 'c' => "black", 's' => 0.35, ],
            'bodyText' => ['position' => 'absolute', 'p' => 0, 'y' => 380, 'l' => 67, 'r' => 67, 'c' => "white", 's' => 0.68, 'lh' => 1.2, ],

            'professionals' => ['l' => 80, 'r' => 400, 'y' => 540, 'h' => 40, 'c' => 'white', 's' => 1.3, 'ff' => 'georgia', ],
            'projects' => ['l' => 298, 'r' => 150, 'y' => 540, 'h' => 40, 'c' => 'white', 's' => 1.3, 'ff' => 'georgia', ],
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
