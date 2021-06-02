<?php


namespace App\utils\Pmc\Assets\Simple;

use App\utils\Pmc\Assets\TemplateRendererCcOnePager;

class SimpleTemplateOnePager extends \App\utils\Pmc\Assets\TemplateAbstract implements \App\utils\Pmc\Assets\Contracts\TemplateContract
{

    public function __construct() {
        $this->templatePath = realpath(__DIR__.'/../../Pages/simple_one_pager.html');
    }

    protected $rendererClass = TemplateRendererCcOnePager::class;
}
