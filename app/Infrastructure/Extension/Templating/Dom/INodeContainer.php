<?php
namespace CMS\Infrastructure\Extension\Templating\Dom;

interface INodeContainer
{
    public function count(): int;
    public function addChild(Index $index, INode $child);
    public function removeChild(Index $index);
}