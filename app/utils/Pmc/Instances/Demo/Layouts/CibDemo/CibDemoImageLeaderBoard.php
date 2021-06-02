<?php


namespace App\utils\Pmc\Instances\Demo\Layouts\CibDemo;

use App\utils\Pmc\Assets\ImageDataSourceCibBanner;

class CibDemoImageLeaderBoard extends \App\utils\Pmc\Assets\AssetImageCibAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1620813697/demo/pmc/assets/v79pkvwfnet3w7ky60mt.png";
    }

    protected $sourceClass = ImageDataSourceCibBanner::class;

    public function GetEmptyPublicId(): string
    {
        return "demo/pmc/assets/v79pkvwfnet3w7ky60mt";
    }

    public function GetBaseColor(): string {
        return "#XXXXXX";
    }

    public function params()
    {
        return [
            'size' => ['w' => 728, 'h' => 90, ],
            'logo' => ['x' => 15, 'y' => 25, 'w' => 107, 'h' => 42, 'a' => 'left', ],
            'cta' => ['l' => 550, 'r' => 22, 'y' => 44, 'h' => 30, 'c' => 'white', 's' => 0.65],
            'headline' => ['l' => 28, 'r' => 18, 'y' => 58, 'c' => "#225793", 'sc' => "#5392c5", 's' => 0.95, ],
            'bodyText' => ['position' => 'below', 'p' => 2, 'l' => 213, 'r' => 188, 'c' => "#0f2d5d", 'ff'=>'sans-serif', 's' => 0.48],
        ];
    }
}
