<?php


namespace App\utils\Pmc\ImageUpload\Contracts;


interface ImageDataAccessContract
{
    public function getDefaultFolder(): string;
    public function getUrl(): ?string;
    public function getJson(): ?\stdClass;
    public function updateUrl(string $url): bool;
    public function updateJson($json): bool;
}
