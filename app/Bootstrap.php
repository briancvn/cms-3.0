<?php

namespace CMS;

class Bootstrap
{
    protected $_executables;

    public function __construct(...$executables)
    {
        $this->_executables = $executables;
    }

    public function run(...$args)
    {
        array_map(function (BootstrapInterface $executable = null) use ($args) {
            array_map([$executable, 'run'], $args);
        }, $this->_executables);
    }
}
