<?php


namespace App\utils\Pmc\Instances\Demo\Layouts\CibDemo;


use App\utils\Pmc\Assets\TemplateRendererCibEmail;

class CibDemoTemplateEmail extends \App\utils\Pmc\Assets\TemplateCibAbstract implements \App\utils\Pmc\Assets\Contracts\TemplateContract
{

    public function __construct() {
        $this->templatePath = realpath(__DIR__.'/Pages/cib_email.html');
    }

    protected $rendererClass = TemplateRendererCibEmail::class;

    protected $templatePageFiles = [
//        'img/logo_1.png',
        'img/img.png',
        'img/header.png',
    ];

}
