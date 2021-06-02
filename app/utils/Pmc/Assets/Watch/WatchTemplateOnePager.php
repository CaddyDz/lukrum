<?php


namespace App\utils\Pmc\Assets\Watch;

use App\utils\Pmc\Assets\TemplateRendererCcOnePager;

class WatchTemplateOnePager extends \App\utils\Pmc\Assets\TemplateAbstract implements \App\utils\Pmc\Assets\Contracts\TemplateContract
{

    public function __construct() {
        $this->templatePath = realpath(__DIR__.'/../../Pages/watch_one_pager.html');
    }

    protected $rendererClass = TemplateRendererCcOnePager::class;

    protected $templatePageFiles = [
//        'img/logo_icon.png',
        'img/header_img.jpg',
    ];

    protected $defaultImage = 'img/header_img.jpg';

}
