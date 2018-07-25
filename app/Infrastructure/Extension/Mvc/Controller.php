<?php

namespace CMS\Infrastructure\Extension\Mvc;

abstract class Controller implements \Phalcon\Mvc\ControllerInterface
{
    public function __construct()
    {
        if (method_exists($this, "onConstruct")) {
            $this->{"onConstruct"}();
        }
    }
}