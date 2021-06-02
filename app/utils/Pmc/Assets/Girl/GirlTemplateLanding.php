<?php


namespace App\utils\Pmc\Assets\Girl;

use App\utils\Pmc\Assets\TemplateRendererCcLanding;

class GirlTemplateLanding extends \App\utils\Pmc\Assets\TemplateAbstract implements \App\utils\Pmc\Assets\Contracts\TemplateContract
{

    public function __construct() {
        $this->templatePath = realpath(__DIR__.'/../../Pages/girl_landing.html');
    }

    protected $rendererClass = TemplateRendererCcLanding::class;

    protected $templatePageFiles = [
//        'img/logo_icon.png',
        'img/img_2.jpg',
    ];

    protected $defaultImage = 'img/img_2.jpg';

}
