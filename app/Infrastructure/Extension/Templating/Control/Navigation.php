<?php
namespace CMS\Infrastructure\Extension\Templating\Control;

use CMS\Infrastructure\Extension\Templating\Control\Navigation\Toolbar;

class Navigation
{
    public function toolbar(string $color = 'primary') {
        return new Toolbar($color);
    }
}