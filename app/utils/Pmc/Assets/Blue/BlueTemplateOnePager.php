<?php


namespace App\utils\Pmc\Assets\Blue;

use App\utils\Pmc\Assets\TemplateRendererCcOnePager;

class BlueTemplateOnePager extends \App\utils\Pmc\Assets\TemplateAbstract implements \App\utils\Pmc\Assets\Contracts\TemplateContract
{

    public function __construct() {
        $this->templatePath = realpath(__DIR__.'/../../Pages/blue_one_pager.html');
    }

    protected $rendererClass = TemplateRendererCcOnePager::class;

    protected $templatePageFiles = [
        'img/logo_icon_2.png',
        'img/header_lines.png',
    ];

    protected $defaultImage = 'img/header_lines.png';
}
