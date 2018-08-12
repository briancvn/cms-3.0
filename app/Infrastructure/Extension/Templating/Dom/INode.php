<?php
namespace CMS\Infrastructure\Extension\Templating\Dom;

interface INode
{
    public function render(): string;
}