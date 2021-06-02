<?php


namespace App\utils\Pmc\Instances;


class InstanceCibHardcodedAbstract extends InstanceCibAbstract implements Contracts\InstanceCibContract
{

    public function Copies(): ?array
    {
        return static::$copies;
    }

    protected static $copies;
}
