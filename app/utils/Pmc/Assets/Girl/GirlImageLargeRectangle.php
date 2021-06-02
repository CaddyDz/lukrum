<?php


namespace App\utils\Pmc\Assets\Girl;

use App\utils\Pmc\Assets\ImageDataSourceBanner;

class GirlImageLargeRectangle extends \App\utils\Pmc\Assets\AssetImageAbstract implements \App\utils\Pmc\Assets\Contracts\AssetImageContract
{

    protected $sourceClass = ImageDataSourceBanner::class;

    public function GetEmptyUrl(): string
    {
        return "https://res.cloudinary.com/pierry/image/upload/v1617288780/pmc/assets/l6gisoc0nns1vxca69ld.png";
    }

    public function GetEmptyPublicId(): string
    {
        return "pmc/assets/l6gisoc0nns1vxca69ld";
    }

    public function GetBaseColor(): string {
        return "#CA5750";
    }

    public function params()
    {
        return [
            'size' => ['w' => 300, 'h' => 600, ],
            'logo' => ['x' => 32, 'y' => 27, 'w' => 125, 'h' => 48, ],
            'cta' => ['l' => 24, 'r' => 24, 'y' => 550, 'h' => 30, 'c' => 'white', 's' => 0.8, ],
            'headline' => ['l' => 31, 'r' => 18, 'y' => 106, 'c' => "black", 'sc' => "asset", 's' => 0.69, ],
            'bodyText' => ['position' => 'below', 'p' => 12, 'l' => 31, 'r' => 18, 'c' => "black", 's' => 0.5318518519, 'ff' => 'sans-serif', ],
            'overlay' => [
                'x' => 0, 'y' => 312, 'w' => 300, 'h' => 288,
                'url' => 'https://res.cloudinary.com/pierry/image/upload/v1616410521/pmc/assets/qdhcnq6mmdgsnotj9lqd.png',
                'public_id' => 'pmc:assets:qdhcnq6mmdgsnotj9lqd',

                'layer2' => [
                    'url' => 'https://res.cloudinary.com/pierry/image/upload/v1617289011/pmc/assets/uuv4wkfiqqeeg1vyp4fj.png',
                    'public_id' => 'pmc:assets:uuv4wkfiqqeeg1vyp4fj',
                ],
            ],

        ];
    }
}
