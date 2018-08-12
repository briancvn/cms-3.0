<?php

namespace CMS\Infrastructure\Extension\Templating\Behavior;

class BehaviorItem
{
    /** @var IBehavior */
    public $behavior;

    /** @var int */
    public $order;

    /** @var boolean */
    public $default;

    public function __construct(IBehavior $behavior, int $order, boolean $default) {
        $this->behavior = $behavior;
        $this->order = $order;
        $this->default = $default;
    }
}
