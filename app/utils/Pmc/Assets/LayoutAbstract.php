<?php


namespace App\utils\Pmc\Assets;


use App\utils\Pmc\Assets\Contracts\AssetImageContract;
use App\utils\Pmc\Assets\Contracts\TemplateContract;
use Illuminate\Support\Collection;

abstract class LayoutAbstract
{
    public function isColorChangeable(): bool {
        return true;
    }

    public function getDefaultColor(): string {
        return "#C95750";
    }

    public function image($code): ?AssetImageContract {
        if(!isset($this->images[$code])) return null;
        $class = $this->images[$code];
        return new $class($this);
    }

    public function template($code): ?TemplateContract {
        if(!isset($this->templates[$code])) return null;
        $class = $this->templates[$code];
        return new $class($this);
    }

    public function hasOverlay(): bool {
        return false;
    }


    public function activeImageCodes(): Collection {
        return collect(array_keys($this->images));
    }

    protected $images = [];
    protected $templates = [];
}
