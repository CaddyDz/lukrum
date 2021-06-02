<?php
if(!function_exists('instance')) {
    function instance(string $instanceCode = null): \App\utils\Pmc\Instances\Contracts\InstanceContract {
        if(!$instanceCode) {
            return \App\utils\Pmc\Instances\InstancesManager::instance()->current();
        } else {
            return \App\utils\Pmc\Instances\InstancesManager::instance()->code($instanceCode);
        }
    }
}
