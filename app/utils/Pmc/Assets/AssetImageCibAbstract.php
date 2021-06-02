<?php


namespace App\utils\Pmc\Assets;


use App\utils\Pmc\Assets\Contracts\AssetImageCibContract;
use App\utils\Pmc\Assets\Contracts\ImageDataSourceContract;
use App\utils\Pmc\PmcForm;


abstract class AssetImageCibAbstract extends AssetImageAbstract implements AssetImageCibContract
{

    public function GetDataSource(PmcForm $pmc): ImageDataSourceContract {
        $class = $this->sourceClass;
        return new $class($pmc, $this->touchPointCode);
    }

    public function SetTouchPoint(string $touchPointCode): AssetImageCibContract {
        $this->touchPointCode = $touchPointCode;
        return $this;
    }

    protected $touchPointCode;

}
