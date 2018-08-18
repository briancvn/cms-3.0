<?php

namespace CMS\Infrastructure\Extension\Templating\Dom;

class Fragment implements INode, INodeContainer
{
    public $children = array();

    public function render(): string {
        return array_reduce($this->children, function($fragment, $node) {
            $fragment .= $node->render();
            return $fragment;
        }, '');
    }

    public function count(): int
    {
        return count($this->children);
    }

    public function addChild(Index $index, INode $child)
    {
        $index->insert($this->children, $child);
    }

    public function removeChild(Index $index)
    {
        $index->insert($this->children);
    }
}
