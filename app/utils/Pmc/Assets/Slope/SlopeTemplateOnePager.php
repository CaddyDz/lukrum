<?php


namespace App\utils\Pmc\Assets\Slope;

use App\utils\Pmc\Assets\TemplateRendererCcOnePager;

class SlopeTemplateOnePager extends \App\utils\Pmc\Assets\TemplateAbstract implements \App\utils\Pmc\Assets\Contracts\TemplateContract
{

    public function __construct() {
        $this->templatePath = realpath(__DIR__.'/../../Pages/slope_one_pager.html');
    }

    protected $rendererClass = TemplateRendererCcOnePager::class;
}
