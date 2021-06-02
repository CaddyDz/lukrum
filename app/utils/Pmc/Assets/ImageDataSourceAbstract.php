<?php


namespace App\utils\Pmc\Assets;


use App\Models\CustomCreative;
use App\utils\Pmc\PmcForm;

class ImageDataSourceAbstract
{
    public function __construct(PmcForm $pmc) {
        $this->pmc = $pmc;
        $this->model = $pmc->GetModel();
    }

    protected function cc(): CustomCreative {
        return $this->model->customCreative;
    }

    /**
     * @var \App\Models\PmcForm
     */
    protected $model;

    /**
     * @var PmcForm
     */
    protected $pmc;

}
