<?php


namespace App\utils\Pmc\Assets;


use App\utils\Pmc\PmcForm;

class ImageDataSourceCibBanner extends ImageDataSourceCibAbstract implements Contracts\ImageDataSourceContract
{


    public function GetHeadline(): string
    {
        $edited = "{$this->touchPointCode}_ads_headline_edited";
        $original = "{$this->touchPointCode}_ads_headline_original";
        return $this->cib()->{$edited} ?? $this->cib()->{$original};
    }

    public function GetBody(): string
    {
        return "";
    }

    public function GetCta(): string
    {
        $edited = "{$this->touchPointCode}_ads_cta_edited";
        $original = "{$this->touchPointCode}_ads_cta_original";
        return $this->cib()->{$edited} ?? $this->cib()->{$original};
    }
}
