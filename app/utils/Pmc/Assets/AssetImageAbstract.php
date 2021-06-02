<?php


namespace App\utils\Pmc\Assets;


use App\utils\Pmc\Assets\Contracts\ImageDataSourceContract;
use App\utils\Pmc\Assets\Contracts\LayoutContract;
use App\utils\Pmc\PmcForm;

abstract class AssetImageAbstract
{

    public function GetDataSource(PmcForm $pmc): ImageDataSourceContract {
        $class = $this->sourceClass;
        return new $class($pmc);
    }

    protected $sourceClass = null;

    public function __construct(LayoutContract $layout)
    {
        $this->layout = $layout;
    }

    /**
     * @var LayoutContract
     */
    protected $layout;
}
