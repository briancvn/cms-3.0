<?php

namespace CMS\Infrastructure\Extension\Templating\Dom;

class Element extends LeafElement implements INodeContainer
{
    /** @var Fragment */
    private $container;

    public function __construct(string $name, $selfClosing = false) {
        parent::__construct($name, $selfClosing);
    }

    public function count(): int
    {
        return $this->container->count();
    }

    public function addContent(string $content)
    {
        $this->selfClosing = false;
        $this->content = $content;
    }

    public function addChild(Index $index, INode $child)
    {
        $this->container->addChild($index, $child);
    }

    public function removeChild(Index $index)
    {
        $this->container->removeChild($index);
    }

    public function createElement(string $name, Index $index = null, $buildAction = null): Element
    {
        $element = new Element($name, $this->selfClosing);
        $this->addChild($index || Index::End(), $element);
        return $element;
    }

    public function createLeaf(string $name, Index $index = null, $buildAction = null): LeafElement
    {
        $element = new LeafElement($name, $this->selfClosing);
        $this->addChild($index || Index::End(), $element);
        return $element;
    }

    public function build(TNode $node, $buildAction): TNode
    {
        $buildAction($node);
        return $node;
    }
}
