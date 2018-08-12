<?php

namespace CMS\Infrastructure\Extension\Templating\Dom;

class ClassSet
{
    private $set = array();

    public function isEmpty(): bool
    {
        return empty($this->set);
    }

    public function add(ClassName $className): ClassSet
    {
        array_push($this->set, $className);
        return $this;
    }

    public function remove(array $className): ClassSet
    {
        if (($key = array_search($className, $this->set)) !== false) {
            unset($this->set[$key]);
        }
        return $this;
    }

    public function toString(): string
    {
        return implode(' ', array_map(function($x) {
            return $x->toString();
        }, array_unique($this->set)));
    }
}
