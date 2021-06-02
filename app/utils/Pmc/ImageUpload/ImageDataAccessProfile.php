<?php


namespace App\utils\Pmc\ImageUpload;


use App\Models\CampaignInABox;
use App\utils\Pmc\PmcForm;

class ImageDataAccessProfile extends ImageDataAccessAbstract implements Contracts\ImageDataAccessContract
{

    public function __construct(PmcForm $pmc)
    {
        parent::__construct($pmc);
        $model = $pmc->GetModel();
        $cib = $model->cib;
        if(!$cib) {
            $cib = new CampaignInABox();
            $cib->form_id = $model->id;
            $cib->save();
        }
        $this->cib = $cib;
    }



    private $cib;

    public function getUrl(): ?string
    {
        return $this->cib->profile_url;
    }

    public function getJson(): ?\stdClass
    {
        $json = json_decode($this->cib->profile_json);
        if(!$json) return null;
        return $json;
    }

    public function updateUrl(string $url): bool
    {
        $this->cib->profile_url = $url;
        $this->cib->save();
        return true;
    }

    public function updateJson($json): bool
    {
        $this->cib->profile_json = $this->getJsonString($json);
        $this->cib->save();
        return true;
    }

    public function getDefaultFolder(): string
    {
        $env = env('APP_ENV', 'default');
        return "{$env}/pmc/profiles";
    }
}
