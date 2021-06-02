<?php


namespace App\utils\Pmc\Assets;


use App\utils\Pmc\Assets\Cib\LayoutCib;
use App\utils\Pmc\Assets\Contracts\TemplateContract;
use App\utils\Pmc\PmcForm;
use function GuzzleHttp\Psr7\str;

class TemplateRendererCibEmailText extends TemplateRendererCibAbstract implements Contracts\TemplateRendererContract
{

    public function Render(TemplateContract $template, PmcForm $pmc): string
    {
        $m = $pmc->GetModel();
        $cib = $m->cib;

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

        return <<<BIGTEXT
$intro

$body

$cta

$address
BIGTEXT;

    }
}
