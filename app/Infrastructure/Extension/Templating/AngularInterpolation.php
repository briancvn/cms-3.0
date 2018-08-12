<?php

namespace CMS\Infrastructure\Extension\Templating;

class AngularInterpolation implements IString
{
    /** @var AngularExpression */
    private $expression;

    public function __construct(string $expression) {
        $this->expression = new AngularExpression($expression);
    }

    public function toString(): string
    {
        return sprintf('{{%s}}', $this->expression->toString());
    }
}
