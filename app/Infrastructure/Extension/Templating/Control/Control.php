<?php
namespace CMS\Infrastructure\Extension\Templating\Control;

use CMS\Infrastructure\Extension\Templating\Behavior\BehaviorSet;
use CMS\Infrastructure\Extension\Templating\Behavior\IBehavior;
use CMS\Infrastructure\Extension\Templating\Dom\INode;
use CMS\Infrastructure\Extension\Templating\Dom\Element;
use CMS\Infrastructure\Extension\Templating\Dom\INodeContainer;

abstract class Control implements INode, IComposite
{
    /** @var BehaviorSet */
    protected $behaviors;

    /** @var Element */
    public $tag;

    public function __construct(string $tagName, $selfClosing = false) {
        $this->behaviors = new BehaviorSet();
        $this->tag = new Element($tagName, $selfClosing);
    }

    public function render(): string {
        $this->beforeBehaviors();
        $this->behaviors->attach($this);
        $this->afterBehaviors();
        return $this->tag->render();
    }

    protected function beforeBehaviors() { }
    protected function afterBehaviors() { }

    public function addBehavior(IBehavior $behavior)
    {
        $this->behaviors->add($behavior);
    }
}