<?php

namespace App\utils\Pmc\Instances\Demo\Layouts\CibDemo;

use App\utils\Pmc\Assets\TemplateRendererCibLanding;

class CibDemoTemplateLanding extends \App\utils\Pmc\Assets\TemplateCibAbstract implements \App\utils\Pmc\Assets\Contracts\TemplateContract
{

    public function __construct() {
        $this->templatePath = realpath(__DIR__.'/Pages/cib_landing.html');
    }

    protected $rendererClass = TemplateRendererCibLanding::class;

    protected $templatePageFiles = [
        'img/header_img.svg',
        'img/main_img.png',
    ];

}
