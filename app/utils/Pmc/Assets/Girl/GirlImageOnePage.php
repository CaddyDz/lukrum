<?php


namespace App\utils\Pmc\Assets\Girl;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class GirlImageOnePage extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1620212394/pmc/assets/lbi0x3pa2xcmwuim3br0.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/lbi0x3pa2xcmwuim3br0";
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
            'logo' => ['x' => 44, 'y' => 80, 'w' => 138, 'h' => 58, ],
            'cta' => ['l' => 45, 'r' => 32, 'y' => 662, 'h' => 40, 'c' => 'black', 's' => 1.5, 'ff' => 'times', ],
            'headline' => ['l' => 45, 'r' => 35, 'y' => 230, 'c' => "asset", 's' => 0.75,],
            'intro' => ['l' => 45, 'r' => 35, 'y' => 365, 'c' => "black", 's' => 0.35, ],
            'bodyText' => ['position' => 'absolute', 'p' => 0, 'y' => 442, 'l' => 45, 'r' => 35, 'c' => "black", 's' => 0.59, 'lh' => 1.2, ],

            'professionals' => ['l' => 45, 'r' => 400, 'y' => 567, 'h' => 40, 'c' => 'black', 's' => 1.3, 'ff' => 'georgia', ],
            'projects' => ['l' => 245, 'r' => 150, 'y' => 567, 'h' => 40, 'c' => 'black', 's' => 1.3, 'ff' => 'georgia', ],

            'overlay' => [
                'x' => 308, 'y' => 0, 'w' => 304, 'h' => 203,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1618584271/pmc/assets/gdcjdt6ndujszlof4bhs.png',
                'public_id' => 'pmc:assets:gdcjdt6ndujszlof4bhs',

            ],

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
