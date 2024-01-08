<?php

namespace App\Includes;

use App\Router\RouterCore;

class ViserRegisteredDependencies{
    private $dependencies = [
        WCSetting::class,
        RouterCore::class,
    ];

    public function load()
    {
        foreach ($this->dependencies as $dependency) {
            $dep = new $dependency();
            $dep->init();
        }
    }
}