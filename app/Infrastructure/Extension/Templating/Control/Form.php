<?php
namespace CMS\Infrastructure\Extension\Templating\Control;

use CMS\Infrastructure\Extension\Templating\Control\Form\Input;

class Form
{
    public function input() {
        return new Input();
    }
}