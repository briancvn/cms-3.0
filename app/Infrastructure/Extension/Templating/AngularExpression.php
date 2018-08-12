<?php

namespace CMS\Infrastructure\Extension\Templating;

class AngularExpression extends RawString implements IAngularExpression
{
    /** @var IAngularExpression */
    private $parentExpression;

    public function __construct(string $expression, IAngularExpression $parentExpression = null) {
        parent::__construct($expression);
        $this->parentExpression = $parentExpression;
    }

    public function toString(): string
    {
        return $this->parentExpression === null
            ? parent::toString()
            : sprintf('%s.%s', $this->parentExpression.$this->toString(), $this->value);
    }
}
