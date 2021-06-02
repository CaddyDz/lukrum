<?php


namespace App\utils\Pmc\Instances\Demo;


class LayoutsManagerDemo extends \App\utils\Pmc\Assets\LayoutsManager implements \App\utils\Pmc\Assets\Contracts\LayoutsManagerContract
{
    protected $cibLayout = Layouts\CibDemo\LayoutCibDemo::class;
}
