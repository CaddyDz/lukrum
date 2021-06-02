<?php


namespace App\utils\Pmc\Assets\Contracts;


use Illuminate\Support\Collection;

interface LayoutContract
{
    public function getCode():string;
    public function getFeaturedImage(): FeaturedImageContract;
    public function getDefaultColor(): string;
    public function isColorChangeable(): bool;
    public function hasOverlay(): bool;

    public function activeImageCodes(): Collection;

    public function image($code): ?AssetImageContract;
    public function template($code): ?TemplateContract;
}
