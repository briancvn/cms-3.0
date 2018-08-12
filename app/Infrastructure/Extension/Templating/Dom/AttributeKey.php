<?php

namespace CMS\Infrastructure\Extension\Templating\Dom;

class AttributeKey extends AttributeName
{
    /** @var BindingType */
    private $binding;

    public function __construct(BindingType $binding, string $value) {
        parent::__construct($value);
        $this->binding = $binding;
    }

    public function toString(): string
    {
        return $this->binding->wrap($this->value);
    }
}
