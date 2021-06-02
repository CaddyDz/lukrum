<?php


namespace App\utils\Pmc\Assets\Blue;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class BlueImageOnePage extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1620212675/pmc/assets/rcqtgt8wfytg7hrsspyv.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/rcqtgt8wfytg7hrsspyv";
    }

    public function GetBaseColor(): string {
        return "#459CD5";
    }

    public function params()
    {
        // 0.26223776223776224
        // 3.24 - 1.44 - 1.20
        // 1.48 - 0.68 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 612, 'h' => 792, ],
            'logo' => ['x' => 46, 'y' => 44, 'w' => 245, 'h' => 63, ],
            'cta' => ['l' => 50, 'r' => 50, 'y' => 537, 'h' => 60, 'c' => 'black', 's' => 1.5, 'ff' => 'times', ],
            'headline' => ['l' => 50, 'r' => 50, 'y' => 178, 'c' => "#072d5e", 's' => 0.75,],
            'intro' => ['l' => 50, 'r' => 50, 'y' => 311, 'c' => "black", 's' => 0.35, ],
            'bodyText' => ['position' => 'absolute', 'p' => 0, 'y' => 383, 'l' => 50, 'r' => 50, 'c' => "black", 's' => 0.59, 'lh' => 1.2, ],

            'overlay' => [
                'x' => 323, 'y' => 39, 'w' => 202, 'h' => 55,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617433154/pmc/assets/kg8x7ocaxip1bqb7ckup.png',
                'public_id' => 'pmc:assets:kg8x7ocaxip1bqb7ckup',
            ],

            'professionals' => ['l' => 180, 'r' => 300, 'y' => 595, 'h' => 40, 'c' => '#1f9ed7', 's' => 1.3, 'ff' => 'georgia', ],
            'projects' => ['l' => 387, 'r' => 50, 'y' => 595, 'h' => 40, 'c' => '#1f9ed7', 's' => 1.3, 'ff' => 'georgia', ],
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
