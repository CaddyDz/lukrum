<?php


namespace App\utils\Pmc\Assets;


use App\Models\CampaignInABox;
use App\utils\Pmc\PmcForm;

class ImageDataSourceCibAbstract extends ImageDataSourceAbstract
{
    public function __construct(PmcForm $pmc, string $touchPointCode) {
        parent::__construct($pmc);
        $this->touchPointCode = $touchPointCode;
    }

    protected $touchPointCode;

    protected function cib(): CampaignInABox {
        return $this->model->cib;
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
