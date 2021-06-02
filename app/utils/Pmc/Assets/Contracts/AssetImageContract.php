<?php


namespace App\utils\Pmc\Assets\Contracts;


use App\utils\Pmc\PmcForm;

interface AssetImageContract
{
    public function GetEmptyUrl(): string;
    public function GetEmptyPublicId(): string;
    public function GetBaseColor(): string;

    public function params();

    public function GetDataSource(PmcForm $pmc): ImageDataSourceContract;
}
