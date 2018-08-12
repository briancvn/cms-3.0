<?php
namespace CMS\Infrastructure\Extension\Templating\Control\Indicator;

use CMS\Infrastructure\Extension\Templating\AngularExpression;
use CMS\Infrastructure\Extension\Templating\Control\Control;

class Icon extends Control
{
    /** @var string */
    private $iconName;

    /** @var string */
    private $svgIcon;

    public function __construct(string $iconName = null) {
        parent::__construct('mat-icon');
        $this->iconName = $iconName;
        return $this;
    }

    public function svgIcon(string $svgIcon): Icon {
        $this->svgIcon = $svgIcon;
        return $this;
    }

    protected function beforeBehaviors() {
        if (!empty($this->iconName)) {
            $this->tag->addContent($this->iconName);
        } if (!empty($this->svgIcon)) {
            $this->tag->attributes->addPlain('svgIcon', new AngularExpression($this->svgIcon));
        }
    }
}