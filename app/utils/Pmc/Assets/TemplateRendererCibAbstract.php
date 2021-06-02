<?php


namespace App\utils\Pmc\Assets;


use App\utils\Pmc\Assets\Contracts\TemplateContract;
use App\utils\Pmc\PmcForm;

abstract class TemplateRendererCibAbstract extends TemplateRendererAbstract
{

    public function __construct($touchPointCode) {
        $this->touchPointCode = $touchPointCode;
    }
    protected $touchPointCode;
}
