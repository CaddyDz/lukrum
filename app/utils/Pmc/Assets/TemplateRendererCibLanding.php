<?php


namespace App\utils\Pmc\Assets;


use App\utils\Pmc\Assets\Cib\LayoutCib;
use App\utils\Pmc\Assets\Contracts\TemplateContract;
use App\utils\Pmc\PmcForm;

class TemplateRendererCibLanding extends TemplateRendererCibAbstract implements Contracts\TemplateRendererContract
{

    public function Render(TemplateContract $template, PmcForm $pmc): string
    {
        $cib = $pmc->GetModel()->cib;

/*
  `tp2_ld_body_original` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `tp2_ld_body_edited` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `tp2_ld_cta_original` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tp2_ld_cta_edited` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
 */
        $edited = "{$this->touchPointCode}_ld_headline_edited";
        $original = "{$this->touchPointCode}_ld_headline_original";
        $headline = $cib->{$edited} ? $cib->{$edited} : $cib->{$original};

        $edited = "{$this->touchPointCode}_ld_intro_edited";
        $original = "{$this->touchPointCode}_ld_intro_original";
        $intro = $cib->{$edited} ? $cib->{$edited} : $cib->{$original};

        $edited = "{$this->touchPointCode}_ld_body_edited";
        $original = "{$this->touchPointCode}_ld_body_original";
        $body = $cib->{$edited} ? $cib->{$edited} : $cib->{$original};

        $edited = "{$this->touchPointCode}_ld_cta_edited";
        $original = "{$this->touchPointCode}_ld_cta_original";
        $cta = $cib->{$edited} ? $cib->{$edited} : $cib->{$original};


        $input = $template->getFullHtml();

        $output = str_replace('[[:logo:]]', "img/{$this->getLogoFileName($pmc)}", $input);

        $output = str_replace('[[:headline:]]', $headline, $output);
        $output = str_replace('[[:intro:]]', $intro, $output);
        $output = str_replace('[[:body:]]', $body, $output);
        $output = str_replace('[[:cta:]]', $cta, $output);

        return $output;
    }
}
