<?php

namespace CMS\Infrastructure\Extension\Templating;

class AngularExpression extends RawString implements IAngularExpression
{
    /** @var IAngularExpression */
    private $parentExpression;

    /** @var string */
    private $accessor = '.';

    public function __construct(string $expression, IAngularExpression $parentExpression = null, bool $safe = false) {
        parent::__construct($expression);
        $this->parentExpression = $parentExpression;
        if ($safe)
        {
            $this->accessor = '?.';
        }
    }

    public function toString(): string
    {
        return $this->parentExpression === null
            ? parent::toString()
            : sprintf('%s%s%s', $this->parentExpression.$this->toString(), $this->accessor, $this->value);
    }

    public function withParent(AngularExpression $parentExpression, bool $safe = false): AngularExpression
    {
        return new AngularExpression($parentExpression->toString(), $this, $safe);
    }

    public function interpolation(): AngularInterpolation
    {
        return new AngularInterpolation($this->value);
    }

    protected function dot(AngularExpression $propOrMethod = null): AngularExpression
    {
        return new AngularExpression($this->value, $propOrMethod);
    }

    protected function dotSafe(AngularExpression $propOrMethod = null): AngularExpression
    {
        return new AngularExpression($this->value, $propOrMethod, true);
    }

    protected function dotPrefix(AngularExpression $prefixExpression): AngularExpression
    {
        return new AngularExpression($prefixExpression->toString(), new AngularExpression($this->value));
    }

    protected function dotSafePrefix(AngularExpression $prefixExpression): AngularExpression
    {
        return new AngularExpression($prefixExpression->toString(), new AngularExpression($this->value), true);
    }

    protected function pipe(string $pipe, ...$pipeArguments): AngularPipeExpression
    {
        return new AngularPipeExpression($this->value, $pipe, $pipeArguments);
    }
}
