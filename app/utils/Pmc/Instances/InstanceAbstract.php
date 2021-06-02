<?php


namespace App\utils\Pmc\Instances;


abstract class InstanceAbstract implements \App\utils\Pmc\Instances\Contracts\InstanceContract
{

    public function CssLinkTag() {
        if($url = $this->manifest()->css_url ?? null) {
            return '<link rel="stylesheet" href="'.$url.'">';
        }
        return '';
    }

    public function FrontEndJson()
    {
        $manifest = $this->manifest();
        $json = new \stdClass();
        $frontEndFields = [
            'logo_url',
            'logo_url_full_page',
            'header_html',
            'sub_header_html',
            'footer_html',
            'elements',
            'password_protected',
            'text_body',
        ];

        foreach($frontEndFields as $f) {
            $exploded = explode('_', $f);
            $first = array_shift($exploded);
            $exploded = array_map('ucfirst', $exploded);
            array_unshift($exploded, $first);
            $ff = implode('', $exploded);
            $json->{$ff} = $manifest->{$f} ?? null;
        }
        return $json;
    }

    public function HasPayment(): bool {
        return (bool)$this->manifest()->has_payment;
    }
    public function HasCalendly(): bool {
        return (bool)$this->manifest()->has_calendly;
    }

    public function Code(): string
    {
        return $this->manifest()->code;
    }

    public function S3Folder(): string
    {
        return $this->manifest()->s3_folder;
    }


    final protected function manifest() {
        if(!$this->cachedManifest) {
            $defaults = DefaultManifest::GetData();
            $this->cachedManifest = json_decode(json_encode($defaults));
            $this->overrideList($this->cachedManifest, $defaults, $this->getManifest());
        }
        return $this->cachedManifest;
    }

    final protected function overrideList($manifest, array $defaults, $override) {
        foreach($defaults as $key => $value) {
            if (isset($override->{$key})) {
                if (is_array($value)) {
                    $this->overrideList($manifest->{$key}, $value, $override->{$key});
                } else {
                    $manifest->{$key} = $override->{$key};
                }
            }
        }
    }

    protected $cachedManifest;

    protected abstract function getManifest();
}
