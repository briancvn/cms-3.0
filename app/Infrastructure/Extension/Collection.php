<?php

namespace CMS\Infrastructure\Extension;

class Collection extends \ArrayObject
{
    public function __construct($input = array()) {
        parent::__construct($input);
    }

    public function forEach($callbackfn)
    {
        foreach ($this as $item) {
            $callbackfn($item);
        }
    }

    public function reduce($callbackfn, $initial = NULL)
    {
        return array_reduce($this, function($accumulator, $currentValue) use($callbackfn) {
            $callbackfn($accumulator, $currentValue);
            return $accumulator;
        }, $initial);
    }

    public function add($item)
    {
        $this.$this->append($item);
    }
}
