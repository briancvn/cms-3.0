<?php
namespace CMS\Infrastructure\Extension\Templating\Control\Navigation;

use CMS\Infrastructure\Extension\Templating\Behavior\AttributeBehavior;
use CMS\Infrastructure\Extension\Templating\Control\Control;
use CMS\Infrastructure\Extension\Templating\Dom\Element;
use CMS\Infrastructure\Extension\Templating\RawString;

class Toolbar extends Control
{
    /** @var RawString */
    private $color;

    /** @var Element */
    private $toolbarRowContainer;

    public function __construct(string $color) {
        parent::__construct('mat-toolbar');
        $this->color = new RawString($color);
        return $this;
    }

    protected function beforeBehaviors() {
        $this->behaviors->add(AttributeBehavior::Plain('color', $this->color));
        $this->tag->createElement('mat-toolbar-row', function(Element $toolbarRowContainer) {
            $toolbarRowContainer->innerHTML = $this->toolbarRowTemplate;
        });
    }

    protected function template($test): Toolbar {
        $this->toolbarRowTemplate = $test;
        return $this;
    }
}