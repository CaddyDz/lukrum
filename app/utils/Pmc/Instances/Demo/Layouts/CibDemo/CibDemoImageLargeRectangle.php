<?php


namespace App\utils\Pmc\Instances\Demo\Layouts\CibDemo;

use App\utils\Pmc\Assets\ImageDataSourceCibBanner;

class CibDemoImageLargeRectangle extends \App\utils\Pmc\Assets\AssetImageCibAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1620811070/demo/pmc/assets/dpwjacfpmuwdlexnb4ak.png";
    }

    protected $sourceClass = ImageDataSourceCibBanner::class;

    public function GetEmptyPublicId(): string
    {
        return "demo/pmc/assets/dpwjacfpmuwdlexnb4ak";
    }

    public function GetBaseColor(): string {
        return "#XXXXXX";
    }

    public function params()
    {
        return [
            'size' => ['w' => 300, 'h' => 600, ],
            'logo' => ['x' => 30, 'y' => 18, 'w' => 111, 'h' => 45, 'a' => 'left', ],
//            'logo2' => ['x' => 97, 'y' => 395, 'w' => 105, 'h' => 38, ],
            'cta' => ['l' => 22, 'r' => 22, 'y' => 558, 'h' => 30, 'c' => 'white', 's' => 0.95,],
            'headline' => ['l' => 28, 'r' => 18, 'y' => 204, 'c' => "#225793", 'sc' => "#5392c5", 's' => 0.95, ],
            'bodyText' => ['position' => 'below', 'p' => 12, 'l' => 28, 'r' => 20, 'c' => "#0f2d5d", 'ff'=>'sans-serif', 's' => 0.85],
        ];
    }
}
