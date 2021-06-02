<?php


namespace App\utils\Pmc\ImageUpload;


use App\utils\Pmc\PmcForm;

class ImageDataAccessLogo extends ImageDataAccessAbstract implements Contracts\ImageDataAccessContract
{

    public function __construct(PmcForm $pmc)
    {
        parent::__construct($pmc);
        $this->model = $pmc->GetModel();
    }

    private $model;

    public function getUrl(): ?string
    {
        return $this->model->logo_url;
    }

    public function getJson(): ?\stdClass
    {
        $json = json_decode($this->model->logo_json);
        if(!$json) return null;
        return $json;
    }

    public function updateUrl(string $url): bool
    {
        $this->model->logo_url = $url;
        $this->model->save();
        return true;
    }

    public function updateJson($json): bool
    {
        $this->model->logo_json = $this->getJsonString($json);
        $this->model->save();
        return true;
    }


    public function getDefaultFolder(): string
    {
        $env = env('APP_ENV', 'default');
        return "{$env}/pmc/logos";
    }
}
