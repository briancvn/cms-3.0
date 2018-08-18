<?php
namespace CMS\Infrastructure\Extension\Templating\Control\Navigation;

use CMS\Infrastructure\Extension\Templating\Behavior\AttributeBehavior;
use CMS\Infrastructure\Extension\Templating\Control\Control;
use CMS\Infrastructure\Extension\Templating\RawString;

class Toolbar extends Control
{
    /** @var RawString */
    private $color;

    public function __construct(string $color) {
        parent::__construct('mat-toolbar');
        $this->color = new RawString($color);
        return $this;
    }

    protected function beforeBehaviors() {
        $this->behaviors->add(AttributeBehavior::Plain('color', $this->color));
    }
}