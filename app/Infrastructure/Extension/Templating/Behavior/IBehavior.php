<?php
namespace CMS\Infrastructure\Extension\Templating\Behavior;

use CMS\Infrastructure\Extension\Templating\Control\IComposite;

interface IBehavior
{
     public function attach(IComposite $composite);
}