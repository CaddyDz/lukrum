<?php


namespace App\utils\Pmc\Assets;


use App\utils\Pmc\Assets\Contracts\TemplateContract;
use App\utils\Pmc\PmcForm;

class TemplateRendererCcLanding extends TemplateRendererAbstract implements Contracts\TemplateRendererContract
{

    public function Render(TemplateContract $template, PmcForm $pmc): string
    {
        $cc = $pmc->GetModel()->customCreative;

        $headline = $cc->ld_headline_edited ? $cc->ld_headline_edited : $cc->ld_headline_original;
        $intro = $cc->ld_subhead_edited ? $cc->ld_subhead_edited : $cc->ld_subhead_original;
        $body = $cc->ld_body_edited ? $cc->ld_body_edited : $cc->ld_body_original;
        $cta = $cc->ld_cta_edited ? $cc->ld_cta_edited : $cc->ld_cta_original;

        $input = $template->getFullHtml();

        $output = str_replace('[[:logo:]]', "img/{$this->getLogoFileName($pmc)}", $input);

        $layout = LayoutsManager::instance()->getLayout($cc->layout_code);

        if($layout->isColorChangeable()) {
            $output = str_replace('[[:color:]]', $pmc->GetModel()->asset_color, $output);
        }

        if($layout->hasOverlay()) {
            $output = str_replace('[[:image:]]', $this->getImageFilePath($template, $pmc), $output);
        }

        $output = str_replace('[[:headline:]]', $headline, $output);
        $output = str_replace('[[:intro:]]', $intro, $output);
        $output = str_replace('[[:body:]]', $body, $output);
        $output = str_replace('[[:cta:]]', $cta, $output);

        return $output;
    }
}
