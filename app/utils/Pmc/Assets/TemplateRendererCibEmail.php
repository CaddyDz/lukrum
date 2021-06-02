<?php


namespace App\utils\Pmc\Assets;


use App\utils\Pmc\Assets\Cib\LayoutCib;
use App\utils\Pmc\Assets\Contracts\TemplateContract;
use App\utils\Pmc\PmcForm;
use function GuzzleHttp\Psr7\str;

class TemplateRendererCibEmail extends TemplateRendererCibAbstract implements Contracts\TemplateRendererContract
{

    public function Render(TemplateContract $template, PmcForm $pmc): string
    {
        $m = $pmc->GetModel();
        $cib = $m->cib;

/*
  `tp2_ld_body_original` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `tp2_ld_body_edited` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `tp2_ld_cta_original` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tp2_ld_cta_edited` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
 */
        $headline = '';

        $edited = "{$this->touchPointCode}_email_intro_edited";
        $original = "{$this->touchPointCode}_email_intro_original";
        $intro = $cib->{$edited} ? $cib->{$edited} : $cib->{$original};

        $edited = "{$this->touchPointCode}_email_body_edited";
        $original = "{$this->touchPointCode}_email_body_original";
        $body = $cib->{$edited} ? $cib->{$edited} : $cib->{$original};

        $edited = "{$this->touchPointCode}_email_cta_edited";
        $original = "{$this->touchPointCode}_email_cta_original";
        $cta = $cib->{$edited} ? $cib->{$edited} : $cib->{$original};


        $address = "{$m->company}. {$m->address}. {$m->city}, {$m->state}. {$m->zip_code}.";
        if($phone = $m->phone) {
            $address .= " Tel {$phone}";
        }

        $input = $template->getFullHtml();

        $output = str_replace('[[:logo:]]', "img/{$this->getLogoFileName($pmc)}", $input);

//        $output = str_replace('[[:headline:]]', $headline, $output);
        $output = str_replace('[[:intro:]]', $intro, $output);
        $output = str_replace('[[:body:]]', $body, $output);
        $output = str_replace('[[:cta:]]', $cta, $output);
        $output = str_replace('[[:address:]]', $address, $output);

        return $output;
    }
}
