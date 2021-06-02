<?php


namespace App\utils\Pmc\Assets\Contracts;


interface AssetImageCibContract extends AssetImageContract
{
    public function SetTouchPoint(string $touchPointCode): AssetImageCibContract;
}
