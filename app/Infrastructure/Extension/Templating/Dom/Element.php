<?php

namespace CMS\Infrastructure\Extension\Templating\Dom;

use CMS\Infrastructure\Extension\Templating\TagBuilder;

class Element extends LeafElement implements INodeContainer
{
    /** @var Fragment */
    private $container;

    public function __construct(string $name, $buildAction = null) {
        parent::__construct($name, $buildAction);
        $this->container = new Fragment();
    }

    public function count(): int
    {
        return $this->container->count();
    }

    public function addChild(Index $index, INode $child)
    {
        $this->container->addChild($index, $child);
    }

    public function removeChild(Index $index)
    {
        $this->container->removeChild($index);
    }

    public function createElement(string $name, $buildAction = null): Element
    {
        $element = new Element($name, $buildAction);
        $this->addChild(Index::End(), $element);
        return $element;
    }

    public function createBuilder(): TagBuilder {
        if ($this->container->count() > 0) {
            $this->innerHTML = $this->container->render();
        }
        return parent::createBuilder();
    }
}
