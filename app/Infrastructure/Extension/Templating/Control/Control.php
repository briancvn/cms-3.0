<?php
namespace CMS\Infrastructure\Extension\Templating\Control;

use CMS\Infrastructure\Common\AbstractClass;
use CMS\Infrastructure\Extension\Templating\Behavior\BehaviorSet;
use CMS\Infrastructure\Extension\Templating\Behavior\IBehavior;
use CMS\Infrastructure\Extension\Templating\Dom\INode;
use CMS\Infrastructure\Extension\Templating\Dom\Element;
use CMS\Infrastructure\Extension\Templating\Dom\INodeContainer;
use CMS\Infrastructure\Extension\Templating\IString;

abstract class Control extends AbstractClass implements INode, IComposite
{
    /** @var BehaviorSet */
    protected $behaviors;

    /** @var Element */
    public $tag;

    public function __construct(string $tagName) {
        $this->behaviors = new BehaviorSet();
        $this->tag = new Element($tagName, null);
    }

    public function render(): string {
        $this->beforeBehaviors();
        $this->behaviors->attach($this);
        $this->afterBehaviors();
        return $this->tag->render();
    }

    public function innerHTML(IString $innerHTML)
    {
        $this->tag->innerHTML = $innerHTML->toString();
    }

    public function addBehavior(IBehavior $behavior)
    {
        $this->behaviors->add($behavior);
    }

    public function addBehaviorIf(bool $condition, IBehavior $behavior)
    {
        if ($condition) {
            $this->behaviors->add($behavior);
        }
    }

    protected function beforeBehaviors() { }
    protected function afterBehaviors() { }
}