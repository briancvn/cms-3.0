<?php
namespace CMS\Infrastructure\Extension\Templating\Control;

use CMS\Infrastructure\Extension\Templating\Control\Indicator\Icon;

class Indicator
{
    public function icon(string $iconName = null) {
        return new Icon($iconName);
    }
}