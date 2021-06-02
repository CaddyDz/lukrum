<?php


namespace App\utils\Pmc\Assets\Contracts;


interface LayoutsManagerContract
{
    public function getLayout($code): ?LayoutContract;
}
