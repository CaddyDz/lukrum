<?php


namespace App\utils\Pmc\Assets\Contracts;


interface ImageDataSourceContract
{
    public function GetHeadline(): string;
    public function GetBody(): string;
    public function GetCta(): string;
}
