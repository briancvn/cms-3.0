<?php
namespace CMS\Infrastructure\Extension\Templating\Control;

use CMS\Infrastructure\Extension\Templating\Behavior\IBehavior;

interface IComposite
{
    public function addBehavior(IBehavior $behavior);
}