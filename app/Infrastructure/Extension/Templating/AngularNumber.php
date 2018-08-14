<?php

namespace CMS\Infrastructure\Extension\Templating;

class AngularNumber extends RawString implements IAngularExpression
{
    public function __construct($number) {
        parent::__construct(strval($number));
    }
}
