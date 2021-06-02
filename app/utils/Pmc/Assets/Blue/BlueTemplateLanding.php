<?php


namespace App\utils\Pmc\Assets\Blue;

use App\utils\Pmc\Assets\TemplateRendererCcLanding;

class BlueTemplateLanding extends \App\utils\Pmc\Assets\TemplateAbstract implements \App\utils\Pmc\Assets\Contracts\TemplateContract
{

    public function __construct() {
        $this->templatePath = realpath(__DIR__.'/../../Pages/blue_landing.html');
    }

    protected $rendererClass = TemplateRendererCcLanding::class;

    protected $templatePageFiles = [
        'img/logo_icon.png',
        'img/header_lines.png',
    ];

    protected $defaultImage = 'img/header_lines.png';
}
