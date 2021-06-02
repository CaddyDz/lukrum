<?php


namespace App\utils\Pmc\Assets;


use App\utils\Pmc\PmcForm;

class ImageDataSourceBanner extends ImageDataSourceAbstract implements Contracts\ImageDataSourceContract
{


    public function GetHeadline(): string
    {
        return $this->cc()->ads_headline_edited ?? $this->cc()->ads_headline_original;
    }

    public function GetBody(): string
    {
        return $this->cc()->ads_body_edited ?? $this->cc()->ads_body_original;
    }

    public function GetCta(): string
    {
        return $this->cc()->ads_cta_edited ?? $this->cc()->ads_cta_original;
    }
}
