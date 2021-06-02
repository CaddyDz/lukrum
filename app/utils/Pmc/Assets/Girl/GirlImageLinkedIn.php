<?php


namespace App\utils\Pmc\Assets\Girl;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class GirlImageLinkedIn extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617452039/pmc/assets/aldc8yvipmeebrbwixkn.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/aldc8yvipmeebrbwixkn";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {

        // 0.25252525252525254
        // 3.24 - 27 - 1.20
        // 1.35 - 0.47 - 0.78
        // 1.37 - - 1.95

        return [
            'size' => ['w' => 1584, 'h' => 768, ],
            'logo' => ['x' => 88, 'y' => 71, 'w' => 248, 'h' => 102, ],
            'cta' => ['l' => 945, 'r' => 112, 'y' => 655, 'h' => 50, 'c' => 'white', 's' => 2.22, ],
            'headline' => ['l' => 88, 'r' => 954, 'y' => 253, 'c' => "asset", 'sc' => "black", 's' => 2.0, ],
            'bodyText' => ['position' => 'none', 'p' => 30, 'l' => 88, 'r' => 917, 'c' => "black", 's' => 0.9/*0.8066666667*/, 'ff' => 'sans-serif', 'lh' => 1.5, ],
            'overlay' => [
                'x' => 730, 'y' => 0, 'w' => 854, 'h' => 768,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617452153/pmc/assets/rr1cegmkgqyxigi4tr17.png',
                'public_id' => 'pmc:assets:rr1cegmkgqyxigi4tr17',

                'layer2' => [
                    'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617452907/pmc/assets/vassa10iode5m1wgtcxp.png',
                    'public_id' => 'pmc:assets:vassa10iode5m1wgtcxp',
                ],
            ],

        ];
    }
}
