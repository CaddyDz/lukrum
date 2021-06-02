<?php


namespace App\utils\Pmc\Assets\Blue;

use App\utils\Pmc\Assets\ImageDataSourceSocialMedia;

class BlueImageFacebook extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{
    protected $sourceClass = ImageDataSourceSocialMedia::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1619118872/pmc/assets/l9fpnvdpbtb6nnppbv4a.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/l9fpnvdpbtb6nnppbv4a";
    }

    public function GetBaseColor(): string {
        return "#459CD5";
    }

    public function params()
    {
        // 0.33333333
        // 27 - 1.44 - 1.20
        // 7.4 - 0.475 - 0.78
        // 1.37 - - 1.95


        return [
            'size' => ['w' => 1200, 'h' => 630, ],
            'logo' => ['x' => 72, 'y' => 59, 'w' => 205, 'h' => 86, ],
            'cta' => ['l' => 86, 'r' => 613, 'y' => 529, 'h' => 40, 'c' => 'white', 's' => 1.95, ],
            'headline' => ['l' => 72, 'r' => 37, 'y' => 201, 'c' => "black", 'sc' => "black", 's' => 1.27, ],
            'bodyText' => ['position' => 'below', 'p' => 18, 'l' => 72, 'r' => 362, 'c' => "white", 's' => 2.2, 'lh' => 1.2, ],

            'overlay' => [
                'x' => 808, 'y' => 54, 'w' => 358, 'h' => 92,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617433154/pmc/assets/kg8x7ocaxip1bqb7ckup.png',
                'public_id' => 'pmc:assets:kg8x7ocaxip1bqb7ckup',
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
