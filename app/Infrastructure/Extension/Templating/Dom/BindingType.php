<?php

namespace CMS\Infrastructure\Extension\Templating\Dom;

class BindingType
{
    private $format;

    public function __construct(string $format) {
        $this->format= $format;
    }

    public function wrap(string $name): string
    {
        return sprintf($this->format, $name);
    }

    public static function Plain(): BindingType
    {
        return new BindingType('%s');
    }

    public static function Input(): BindingType
    {
        return new BindingType('[%s]');
    }

    public static function Output(): BindingType
    {
        return new BindingType('(%s)');
    }

    public static function TwoWay(): BindingType
    {
        return new BindingType('[(%s)]');
    }

    public static function Structural(): BindingType
    {
        return new BindingType('*%s');
    }

    public static function TemplateRef(): BindingType
    {
        return new BindingType('#%s');
    }
}
