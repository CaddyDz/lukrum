<?php


namespace App\utils\Pmc\Assets\Contracts;


use App\utils\Pmc\PmcForm;

interface TemplateContract
{

//    public function getPreviewHtml(): string;

    public function getFullHtml(): string;

    public function getRenderedHtml(PmcForm $pmc): string;
    public function getPageFilesList(): array;

    public function getDefaultImage(): string;

//    public function GetEmptyUrl(): string;
//    public function GetEmptyPublicId(): string;
//    public function GetBaseColor(): string;

//    public function params();

//    public function GetDataSource(PmcForm $pmc): ImageDataSourceContract;
}
