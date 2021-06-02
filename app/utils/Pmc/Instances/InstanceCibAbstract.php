<?php


namespace App\utils\Pmc\Instances;


abstract class InstanceCibAbstract implements Contracts\InstanceCibContract
{

    public function Enabled(): bool
    {
        return true;
    }
}
