<?php

namespace CMS\Infrastructure\Extension\Templating;

class TemplateRef implements IAngularExpression
{
    /** @var string */
    public $name;

    /** @var string */
    public $type;

    public function __construct(string $name, string $type = null) {
        $this->name = $name;
        $this->type = $type;
    }

    public function toString(): string
    {
        return $this->name;
    }

    public function withName(string $name): TemplateRef
    {
        return new TemplateRef($name, $this->type);
    }
}
