<?php

namespace CMS\Infrastructure\Extension\Templating\Dom;

use CMS\Infrastructure\Extension\Templating\RawString;

class AttributeName extends RawString
{
    private $format;

    public function __construct(string $value) {
        parent::__construct($value);
    }

    public function withBinding(BindingType $binding): AttributeKey
    {
        return new AttributeKey($binding, $this->value);
    }
}
