<?php

namespace CMS\Infrastructure\Extension\Templating\Dom;

use CMS\Infrastructure\Extension\Templating\TagBuilder;
use Comsolit\HTMLBuilder\TextTag;

class LeafElement implements INode
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $content;

    /** @var boolean */
    protected $selfClosing;

    /** @var ClassSet */
    public $classes;

    /** @var AttributeCollection */
    public $attributes;

    public function __construct(string $name, $selfClosing = false) {
        $this->name = $name;
        $this->selfClosing = $selfClosing;
        $this->classes = new ClassSet();
        $this->attributes = new AttributeCollection();
    }

    public function render(): string
    {
        return $this->createBuilder()->build();
    }

    public function createBuilder(): TagBuilder {
        $builder = new TagBuilder($this->name);
        if (!empty($this->content)) {
            $builder->addChild(new TextTag($this->content));
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
}