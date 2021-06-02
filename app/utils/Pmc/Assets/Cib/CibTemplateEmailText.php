<?php


namespace App\utils\Pmc\Assets\Cib;


use App\utils\Pmc\Assets\TemplateRendererCibEmailText;

class CibTemplateEmailText extends \App\utils\Pmc\Assets\TemplateCibAbstract implements \App\utils\Pmc\Assets\Contracts\TemplateContract
{
    protected $rendererClass = TemplateRendererCibEmailText::class;
}
