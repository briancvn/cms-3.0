<?php

namespace CMS\Infrastructure\Extension\Templating;

class RawString implements IString
{
    /** @var string */
    protected $value;

    public function __construct(string $value) {
        $this->value = $value;
    }

    public function toString(): string
    {
        return $this->value;
    }
}
