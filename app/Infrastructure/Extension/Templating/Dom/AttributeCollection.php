<?php

namespace CMS\Infrastructure\Extension\Templating\Dom;

use CMS\Infrastructure\Extension\Templating\IString;

class AttributeCollection
{
    private $attributes = array();

    public function add(AttributeKey $name, IString $value): AttributeCollection
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    public function addPlain(string $name, IString $value): AttributeCollection
    {
        $this->attributes[$this->getAttribute($name, BindingType::Plain())] = $value->toString();
        return $this;
    }

    public function addInputBinding(AttributeName $name, IString $value): AttributeCollection
    {
        $this->attributes[$this->getAttribute($name, BindingType::Input())] = $value->toString();
        return $this;
    }

    public function addOutputBinding(AttributeName $name, IString $value): AttributeCollection
    {
        $this->attributes[$this->getAttribute($name, BindingType::Output())] = $value->toString();
        return $this;
    }

    public function addTwoWayBinding(AttributeName $name, IString $value): AttributeCollection
    {
        $this->attributes[$this->getAttribute($name, BindingType::TwoWay())] = $value->toString();
        return $this;
    }

    public function addStructuralBinding(AttributeName $name, IString $value): AttributeCollection
    {
        $this->attributes[$this->getAttribute($name, BindingType::Structural())] = $value->toString();
        return $this;
    }

    public function addTemplateRef(AttributeName $name, IString $value): AttributeCollection
    {
        $this->attributes[$this->getAttribute($name, BindingType::TemplateRef())] = $value->toString();
        return $this;
    }

    public function has(string $name): boolean
    {
        return in_array($name, $this->attributes);
    }

    public function remove(string $name)
    {
        unset($this->attributes[$name]);
    }

    public function toArray(): array
    {
        return $this->attributes;
    }

    private function getAttribute(string $name, BindingType $bindingType): string
    {
        return (new AttributeName($name))->withBinding($bindingType)->toString();
    }
}
