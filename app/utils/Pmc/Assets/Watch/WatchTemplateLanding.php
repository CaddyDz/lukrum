<?php


namespace App\utils\Pmc\Assets\Watch;

use App\utils\Pmc\Assets\TemplateRendererCcLanding;

class WatchTemplateLanding extends \App\utils\Pmc\Assets\TemplateAbstract implements \App\utils\Pmc\Assets\Contracts\TemplateContract
{

    public function __construct() {
        $this->templatePath = realpath(__DIR__.'/../../Pages/watch_landing.html');
    }

    protected $rendererClass = TemplateRendererCcLanding::class;

    protected $templatePageFiles = [
//        'img/logo_icon.png',
        'img/header_img.jpg',
    ];

    protected $defaultImage = 'img/header_img.jpg';

}
