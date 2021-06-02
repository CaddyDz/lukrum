<?php


namespace App\utils\Pmc\Instances;


abstract class InstanceHardcodedAbstract extends InstanceAbstract implements Contracts\InstanceContract
{
    protected function getManifest()
    {
        if(!$this->manifestCache) {
            $this->manifestCache = json_decode(json_encode($this->arrayDescriptor));
        }
        return $this->manifestCache;
    }

    private $manifestCache;

    protected $arrayDescriptor = ['to_be' => 'overwritten', ];
}
