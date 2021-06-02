<?php


namespace App\utils\Pmc\Assets\Contracts;


use App\utils\Pmc\PmcForm;

interface TemplateRendererContract
{
    public function Render(TemplateContract $template, PmcForm $pmc): string;
}
