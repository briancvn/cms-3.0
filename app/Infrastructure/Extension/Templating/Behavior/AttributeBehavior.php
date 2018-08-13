<?php

namespace CMS\Infrastructure\Extension\Templating\Behavior;

use CMS\Infrastructure\Common\AbstractClass;
use CMS\Infrastructure\Extension\Templating\Control\IComposite;
use CMS\Infrastructure\Extension\Templating\Dom\AttributeKey;
use CMS\Infrastructure\Extension\Templating\Dom\AttributeName;
use CMS\Infrastructure\Extension\Templating\Dom\BindingType;
use CMS\Infrastructure\Extension\Templating\IAngularExpression;
use CMS\Infrastructure\Extension\Templating\IString;
use CMS\Infrastructure\Extension\Templating\RawString;
use CMS\Infrastructure\Extension\Templating\TemplateRef;

class AttributeBehavior extends AbstractClass implements IBehavior
{
    /** @var AttributeKey */
    private $name;

    /** @var IString */
    private $value;

    /** @var string */
    public $identifier;

    public function __construct(AttributeKey $name, IString $value) {
        $this->identifier = $name->value;
        $this->name = $name;
        $this->value = $value;
    }

    public function attach(IComposite $composite)
    {
        $composite->tag->attributes->add($this->name, $this->value);
    }

    protected static function Plain(AttributeName $name, IString $value): AttributeBehavior
    {
        return new AttributeBehavior($name->withBinding(BindingType::Plain()), $value);
    }

    protected static function InputBinding(AttributeName $name, IAngularExpression $value): AttributeBehavior
    {
        return new AttributeBehavior($name->withBinding(BindingType::Input()), $value);
    }

    protected static function OutputBinding(AttributeName $name, IAngularExpression $value): AttributeBehavior
    {
        return new AttributeBehavior($name->withBinding(BindingType::Output()), $value);
    }

    protected static function TwoWayBinding(AttributeName $name, IAngularExpression $value): AttributeBehavior
    {
        return new AttributeBehavior($name->withBinding(BindingType::TwoWay()), $value);
    }

    protected static function StructuralBinding(AttributeName $name, IAngularExpression $value): AttributeBehavior
    {
        return new AttributeBehavior($name->withBinding(BindingType::Structural()), $value);
    }

    protected static function TemplateRef(TemplateRef $templateRef): AttributeBehavior
    {
        $name = new AttributeName($templateRef->name);
        return new AttributeBehavior($name->withBinding(BindingType::TemplateRef()), $templateRef->type == null ? null : new RawString($templateRef->type));
    }
}
