<?php
namespace CMS\Infrastructure\Extension\Cache;

use CMS\Infrastructure\Extension\Utils;

class ControllerCache
{
    public $name;
    public $actions = array();

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addAction(ActionCache $action): void {
        array_push($this->actions, $action);
    }

    public function getAction(string $actionName): ActionCache {
        return Utils::array_find($this->actions, function(ActionCache $action) use($actionName) {
            return  $action->name === $actionName;
        });
    }
}