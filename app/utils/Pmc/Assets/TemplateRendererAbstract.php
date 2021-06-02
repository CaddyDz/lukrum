<?php


namespace App\utils\Pmc\Assets;


use App\utils\Pmc\Assets\Contracts\TemplateContract;
use App\utils\Pmc\PmcForm;

abstract class TemplateRendererAbstract
{
    protected function getLogoFileName(PmcForm $pmc):string {
        $m = $pmc->GetModel();
        $extension = 'png';
        if($url = $m->logo_url) {
            $exploded = explode('.', $url);
            $extension = array_pop($exploded);
        }
        return "logo.{$extension}";
    }

    protected function getImageFilePath(TemplateContract $template, PmcForm $pmc):string {

        $result = $template->getDefaultImage();

        $m = $pmc->GetModel();
        if($cc = $m->customCreative) {
            $extension = 'png';
            if($url = $cc->overlay_url) {
                $exploded = explode('.', $url);
                $extension = array_pop($exploded);
            }

            $result = "img/image.{$extension}";
        }

        return $result;
    }
}
