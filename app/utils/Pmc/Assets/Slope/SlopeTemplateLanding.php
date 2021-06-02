<?php


namespace App\utils\Pmc\Assets\Slope;

use App\utils\Pmc\Assets\TemplateRendererCcLanding;

class SlopeTemplateLanding extends \App\utils\Pmc\Assets\TemplateAbstract implements \App\utils\Pmc\Assets\Contracts\TemplateContract
{

    public function __construct() {
        $this->templatePath = realpath(__DIR__.'/../../Pages/slope_landing.html');
    }

    protected $rendererClass = TemplateRendererCcLanding::class;
}
