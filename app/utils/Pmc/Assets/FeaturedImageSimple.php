<?php


namespace App\utils\Pmc\Assets;


class FeaturedImageSimple implements Contracts\FeaturedImageContract
{

    public function getUrl(): string
    {
        return $this->url;
    }

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    private $url;
}
