<?php


namespace App\utils\Pmc\Assets\Watch;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class WatchImageOnePage extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1620212489/pmc/assets/uziyfqjtaj8edjryt7ha.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/uziyfqjtaj8edjryt7ha";
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
            'logo' => ['x' => 44, 'y' => 172, 'w' => 113, 'h' => 47, ],
            'cta' => ['l' => 45, 'r' => 32, 'y' => 652, 'h' => 60, 'c' => 'asset', 's' => 1.5, 'ff' => 'times', ],
            'headline' => ['l' => 45, 'r' => 35, 'y' => 270, 'c' => "asset", 's' => 0.75,],
            'intro' => ['l' => 45, 'r' => 35, 'y' => 386, 'c' => "black", 's' => 0.35, ],
            'bodyText' => ['position' => 'absolute', 'p' => 0, 'y' => 455, 'l' => 45, 'r' => 35, 'c' => "black", 's' => 0.59, 'lh' => 1.2, ],

            'professionals' => ['l' => 45, 'r' => 400, 'y' => 565, 'h' => 40, 'c' => 'asset', 's' => 1.3, 'ff' => 'georgia', ],
            'projects' => ['l' => 299, 'r' => 150, 'y' => 565, 'h' => 40, 'c' => 'asset', 's' => 1.3, 'ff' => 'georgia', ],

            'overlay' => [
                'x' => 0, 'y' => 0, 'w' => 612, 'h' => 199,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1618583285/pmc/assets/bsv3qgg0moua6bxdvnzb.png',
                'public_id' => 'pmc:assets:bsv3qgg0moua6bxdvnzb',

                'layer2' => [
                    'url' => 'https://res.cloudinary.com/pierry/image/upload/v1618583318/pmc/assets/emuj4w3hh2rf2iojy3db.png',
                    'public_id' => 'pmc:assets:emuj4w3hh2rf2iojy3db',
                ],
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
