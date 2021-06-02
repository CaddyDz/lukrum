<?php


namespace App\utils\Pmc\Instances\Demo\Layouts\CibDemo;

use App\utils\Pmc\Assets\ImageDataSourceCibBanner;

class CibDemoImageSkyScrapper extends \App\utils\Pmc\Assets\AssetImageCibAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1620812964/demo/pmc/assets/fxuvcy2eiccoaovphhe3.png";
    }

    protected $sourceClass = ImageDataSourceCibBanner::class;

    public function GetEmptyPublicId(): string
    {
        return "demo/pmc/assets/fxuvcy2eiccoaovphhe3";
    }

    public function GetBaseColor(): string {
        return "#XXXXXX";
    }

    public function params()
    {
        return [
            'size' => ['w' => 120, 'h' => 600, ],
            'logo' => ['x' => 15, 'y' => 18, 'w' => 95, 'h' => 37, 'a' => 'left', ],
//            'logo2' => ['x' => 33, 'y' => 494, 'w' => 52, 'h' => 22, ],
            'cta' => ['l' => 17, 'r' => 17, 'y' => 377, 'h' => 70, 'c' => 'white', 's' => 0.70, 'ml' => true,],
            'headline' => ['l' => 28, 'r' => 18, 'y' => 254, 'c' => "#225793", 'sc' => "#5392c5", 's' => 0.95, ],
            'bodyText' => ['position' => 'below', 'p' => 2, 'l' => 10, 'r' => 13, 'c' => "#0f2d5d", 'ff'=>'sans-serif', 's' => 0.53],
        ];
    }
}
