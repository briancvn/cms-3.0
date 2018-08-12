<?php
namespace CMS\Infrastructure\Extension\Templating\Control\Form;

use CMS\Infrastructure\Extension\Templating\Control\Control;
use CMS\Infrastructure\Extension\Templating\Dom\ClassName;

class Input extends Control
{
    public function __construct() {
        parent::__construct('input', true);
    }

    public function test(): Input {
        $this->tag->classes->add(new ClassName('test'));
        return $this;
    }
}