<?php

namespace CMS\Infrastructure\Extension\Templating;

class MomentPipeExpression extends AngularPipeExpression
{
    public function __construct(string $expression, string $defaultDateTimePattern = 'defaultMinusValue') {
        parent::__construct($expression, 'moment', (new AngularString($defaultDateTimePattern))->toString());
    }
}
