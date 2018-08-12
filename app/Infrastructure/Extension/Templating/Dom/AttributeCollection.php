<?php

namespace CMS\Infrastructure\Extension\Templating\Dom;

use CMS\Infrastructure\Common\AbstractClass;
use CMS\Infrastructure\Extension\Templating\IString;

class AttributeCollection extends AbstractClass
{
    private $attributes = array();

    protected function add(AttributeKey $name, IString $value): AttributeCollection
    {
        $this->attributes[$name->toString()] = $value->toString();
        return $this;
    }

    protected function addPlain(AttributeName $name, IString $value): AttributeCollection
    {
        $this->attributes[$this->getAttribute($name, BindingType::Plain())] = $value->toString();
        return $this;
    }

    protected function addInputBinding(AttributeName $name, IString $value): AttributeCollection
    {
        $this->attributes[$this->getAttribute($name, BindingType::Input())] = $value->toString();
        return $this;
    }

    protected function addOutputBinding(AttributeName $name, IString $value): AttributeCollection
    {
        $this->attributes[$this->getAttribute($name, BindingType::Output())] = $value->toString();
        return $this;
    }

    protected function addTwoWayBinding(AttributeName $name, IString $value): AttributeCollection
    {
        $this->attributes[$this->getAttribute($name, BindingType::TwoWay())] = $value->toString();
        return $this;
    }

    protected function addStructuralBinding(AttributeName $name, IString $value): AttributeCollection
    {
        $this->attributes[$this->getAttribute($name, BindingType::Structural())] = $value->toString();
        return $this;
    }

    protected function addTemplateRef(AttributeName $name, IString $value): AttributeCollection
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

    private function getAttribute(AttributeName $name, BindingType $bindingType): string
    {
        return $name->withBinding($bindingType)->toString();
    }
}
