<?php


namespace App\utils\Pmc\ImageUpload;


use App\Models\CustomCreative;
use App\utils\Pmc\PmcForm;

class ImageDataAccessOverlay extends ImageDataAccessAbstract implements Contracts\ImageDataAccessContract
{

    public function __construct(PmcForm $pmc)
    {
        parent::__construct($pmc);
        $model = $pmc->GetModel();
        $cc = $model->customCreative;
        if(!$cc) {
            $cc = new CustomCreative();
            $cc->form_id = $model->id;
            $cc->save();
        }
        $this->cc = $cc;
    }



    private $cc;

    public function getUrl(): ?string
    {
        return $this->cc->overlay_url;
    }

    public function getJson(): ?\stdClass
    {
        $json = json_decode($this->cc->overlay_json);
        if(!$json) return null;
        return $json;
    }

    public function updateUrl(string $url): bool
    {
        $this->cc->overlay_url = $url;
        $this->cc->save();
        return true;
    }

    public function updateJson($json): bool
    {
        $this->cc->overlay_json = $this->getJsonString($json);
        $this->cc->save();
        return true;
    }


    public function getDefaultFolder(): string
    {
        $env = env('APP_ENV', 'default');
        return "{$env}/pmc/overlays";
    }
}
