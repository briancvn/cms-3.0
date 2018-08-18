<?php

namespace CMS\Infrastructure\Extension\Templating\Dom;

class Index
{
    /** @var string */
    private $root;

    /** @var int */
    private $index;

    public function __construct(string $root, int $index) {
        $this->root = $root;
        $this->index = $index;
    }

    public function insert(array &$list, $item) {
        $list[$this->absolute($list)] = $item;
    }

    public function remove(array &$list) {
        unset($list[$this->absolute($list)]);
    }

    public function absolute(array &$list): int {
        return $this->root === IndexRoot::Start
            ? $this->index
            : count($list) - $this->index;
    }

    public static function Start(): Index
    {
        return new Index(IndexRoot::Start, 0);
    }

    public static function End(): Index
    {
        return new Index(IndexRoot::End, 0);
    }
}
