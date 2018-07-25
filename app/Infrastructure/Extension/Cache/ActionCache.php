<?php
namespace CMS\Infrastructure\Extension\Cache;

class ActionCache
{
    public $name;
    public $paramType;

    public function __construct($name, $paramType = null)
    {
        $this->name = $name;
        $this->paramType = $paramType;
    }
}