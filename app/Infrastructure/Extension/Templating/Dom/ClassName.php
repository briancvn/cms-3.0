<?php

namespace CMS\Infrastructure\Extension\Templating\Dom;

use CMS\Infrastructure\Extension\Templating\RawString;

class ClassName extends RawString
{
    public function __construct(string $className) {
        parent::__construct($className);
    }
}
