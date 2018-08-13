<?php

namespace CMS\Infrastructure\Extension\Templating\Behavior;

class BehaviorItem
{
    /** @var IBehavior */
    public $behavior;

    /** @var int */
    public $order;

    /** @var bool */
    public $default;

    public function __construct(IBehavior $behavior, int $order, bool $default = false) {
        $this->behavior = $behavior;
        $this->order = $order;
        $this->default = $default;
    }
}
