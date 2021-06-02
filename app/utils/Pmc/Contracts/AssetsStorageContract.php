<?php


namespace App\utils\Pmc\Contracts;


use Illuminate\Support\Collection;

interface AssetsStorageContract
{
    public function ActiveList():Collection;

    public function SearchById($id);
}
