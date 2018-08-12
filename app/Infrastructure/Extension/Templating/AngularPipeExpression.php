<?php

namespace CMS\Infrastructure\Extension\Templating;

class AngularPipeExpression implements IAngularExpression
{
    /** @var AngularExpression */
    private $expression;

    /** @var string */
    private $pipe;

    /** @var array */
    private $pipeArguments;

    public function __construct(string $expression, string $pipe, array $pipeArguments = array()) {
        $this->expression = new AngularExpression($expression);
        $this->pipe = $pipe;
        $this->pipeArguments = $pipeArguments;
    }

    public function toString(): string
    {
        $arguments = implode(',', $this->pipeArguments);
        $pipe = empty1($arguments) ? $this->pipe : sprintf('%s:%s', $this->pipe, $arguments);
        return sprintf('%s|%s', $this->expression->toString(), $pipe);
    }
}
