<?php


namespace App\utils\Pmc\Assets;


use App\utils\Pmc\PmcForm;

class ImageDataSourceSocialMedia extends ImageDataSourceAbstract implements Contracts\ImageDataSourceContract
{


    public function GetHeadline(): string
    {
        return $this->cc()->sm_headline_edited ?? $this->cc()->sm_headline_original;
    }

    public function GetBody(): string
    {
        return $this->cc()->sm_body_edited ?? $this->cc()->sm_body_original;
    }

    public function GetCta(): string
    {
        return $this->cc()->sm_cta_edited ?? $this->cc()->sm_cta_original;
    }
}
