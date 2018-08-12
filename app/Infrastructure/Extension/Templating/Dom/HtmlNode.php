<?php

namespace CMS\Infrastructure\Extension\Templating\Dom;

class HtmlNode implements INode
{
    /** @var string */
    protected $html;

    public function __construct(string $html) {
        $this->html = $html;
    }

    public function render(): string {
        return $this->html;
    }
}
