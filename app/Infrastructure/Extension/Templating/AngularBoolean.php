<?php

namespace CMS\Infrastructure\Extension\Templating;

class AngularBoolean implements IAngularExpression
{
    /** @var boolean */
    private $value;

    public function __construct(boolean $value) {
        $this->value = $value;
    }

    public function toString(): string
    {
        return $this->value ? 'true' : 'false';
    }
}
