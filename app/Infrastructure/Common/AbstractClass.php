<?php
namespace CMS\Infrastructure\Common;

abstract class AbstractClass
{
    public function __construct(array $properties = array())
    {
        foreach ($properties as $property => $value)
        {
            $this->$property = $value;
        }
    }

    public function __call($name, $arguments)
    {
        $reflectMethod = new \ReflectionMethod($this, $name);
        foreach ($reflectMethod->getParameters() as $index => $param) {
            if (!$param->getClass() || $param->getClass()->isInterface()) {
                continue;
            }
            $paramType = $param->getType()->getName();
            $argumentType = is_object($arguments[$index]) ? get_class($arguments[$index]) : null;
            if ($argumentType !== $paramType) {
                $arguments[$index] = new $paramType($arguments[$index]);
            }
        }
        return call_user_func_array([$this, $name], $arguments);
    }
}