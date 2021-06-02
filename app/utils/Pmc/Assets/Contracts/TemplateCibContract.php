<?php


namespace App\utils\Pmc\Assets\Contracts;

use App\utils\Pmc\PmcForm;

interface TemplateCibContract extends TemplateContract
{
    public function SetTouchPoint(string $touchPointCode): TemplateCibContract;
}
