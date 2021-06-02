<?php


namespace App\utils\Pmc\Assets\Girl;

use App\utils\Pmc\Assets\TemplateRendererCcOnePager;

class GirlTemplateOnePager extends \App\utils\Pmc\Assets\TemplateAbstract implements \App\utils\Pmc\Assets\Contracts\TemplateContract
{

    public function __construct() {
        $this->templatePath = realpath(__DIR__.'/../../Pages/girl_one_pager.html');
    }

    protected $rendererClass = TemplateRendererCcOnePager::class;

    protected $templatePageFiles = [
//        'img/logo_icon.png',
        'img/header_img.png',
    ];

    protected $defaultImage = 'img/header_img.png';

}
