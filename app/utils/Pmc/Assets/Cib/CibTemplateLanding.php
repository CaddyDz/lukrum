<?php


namespace App\utils\Pmc\Assets\Cib;


use App\utils\Pmc\Assets\TemplateRendererCibLanding;

class CibTemplateLanding extends \App\utils\Pmc\Assets\TemplateCibAbstract implements \App\utils\Pmc\Assets\Contracts\TemplateContract
{

    public function __construct() {
        $this->templatePath = realpath(__DIR__.'/../../Pages/cib_landing.html');
    }

    protected $rendererClass = TemplateRendererCibLanding::class;

    protected $templatePageFiles = [
        'img/logo_1.svg',
        'img/header_img.svg',
        'img/main_img.png',
    ];

}
