<?php

namespace CMS\Infrastructure\Extension\Templating\Dom;

use CMS\Infrastructure\Extension\Templating\TagBuilder;
use Comsolit\HTMLBuilder\TextTag;

class LeafElement implements INode
{
    /** @var string */
    public $innerHTML;

    /** @var ClassSet */
    public $classes;

    /** @var AttributeCollection */
    public $attributes;

    /** @var boolean */
    protected $selfClosing = false;

    /** @var string */
    protected $name;

    public function __construct(string $name, $buildAction = null) {
        $this->name = $name;
        $this->classes = new ClassSet();
        $this->attributes = new AttributeCollection();
        $this->build($this, $buildAction);
    }

    public function selfClosing($selfClosing = true)
    {
        $this->selfClosing = $selfClosing;
    }

    public function render(): string
    {
        return $this->createBuilder()->build();
    }

    public function createBuilder(): TagBuilder {
        $builder = new TagBuilder($this->name);
        if (!empty($this->innerHTML)) {
            $builder->addChild(new TextTag($this->innerHTML));
            $this->selfClosing = false;
        }
        if ($this->selfClosing) {
            $builder->setVoid();
        }
        $builder->mergeAttributes($this->attributes->toArray());
        if (!$this->classes->isEmpty())
        {
            $builder->addClass($this->classes->toString());
        }
        return $builder;
    }

    protected function build($node, $buildAction)
    {
        if (!is_null($buildAction)) {
            $buildAction($node);
        }
        return $node;
    }
}
