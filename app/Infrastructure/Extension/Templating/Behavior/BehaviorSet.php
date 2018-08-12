<?php

namespace CMS\Infrastructure\Extension\Templating\Behavior;

use CMS\Infrastructure\Extension\Templating\Control\IComposite;
use Underscore\Types\Arrays;

class BehaviorSet
{
    private $set = array();
    private $behaviorOrder = 0;

    public function add(IBehavior $behavior)
    {
        if (array_key_exists($behavior->identifier, $this->set) && !$this->set[$behavior->identifier]->default) {
            throw new Error('A control can only have one behavior of any given type. Duplicate '.$behavior->identifier.' behavior found.');
        }
        $this->set[$behavior->identifier] = new BehaviorItem($behavior, $this->behaviorOrder++);
    }

    public function addDefault(IBehavior $behavior)
    {
        if (array_key_exists($behavior->identifier, $this->set)) {
            throw new Error('A control can only have one behavior of any given type. Duplicate '.$behavior->identifier.' behavior found.');
        }
        $this->set[$behavior->identifier] = new BehaviorItem($behavior, $this->behaviorOrder++, true);
    }

    public function attach(IComposite $composite)
    {
        $setOrder = Arrays::sort($this->set, function($item) {
            return $item->order;
        });
        foreach ($setOrder as $identifier => $behaviorItem)
        {
            $behaviorItem->behavior->attach($composite);
        }
    }
}
