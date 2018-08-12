<?php

namespace CMS\Infrastructure\Extension\Templating;

use CMS\Infrastructure\Extension\Utils;

class AngularString extends AngularExpression
{
    public function __construct(string $str) {
        parent::__construct($str);
    }

    public function toString(): string
    {
        return str_replace('"','\'',Utils::escapeJavascriptString($this->value));
    }
}
