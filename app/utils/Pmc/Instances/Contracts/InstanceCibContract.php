<?php


namespace App\utils\Pmc\Instances\Contracts;


interface InstanceCibContract
{
    public function Enabled(): bool;
    public function Copies(): ?array;
}
