<?php
namespace CMS\Infrastructure\Extension\Templating\Control\Indicator;

use CMS\Infrastructure\Extension\Templating\AngularExpression;
use CMS\Infrastructure\Extension\Templating\Behavior\AttributeBehavior;
use CMS\Infrastructure\Extension\Templating\Control\Control;
use CMS\Infrastructure\Extension\Templating\RawString;

class Icon extends Control
{
    /** @var RawString */
    private $iconName;

    /** @var AngularExpression */
    private $svgIcon;

    public function __construct(string $iconName = null) {
        parent::__construct('mat-icon');
        $this->iconName = empty($iconName) ? null : new RawString($iconName);
        return $this;
    }

    protected function beforeBehaviors() {
        if (!is_null($this->iconName)) {
            $this->innerHTML($this->iconName);
        } else if (!empty($this->svgIcon)) {
            $this->addBehavior(AttributeBehavior::Plain('svgIcon', $this->svgIcon));
        }
    }

    protected function svgIcon(AngularExpression $svgIcon): Icon {
        $this->svgIcon = $svgIcon;
        return $this;
    }
}