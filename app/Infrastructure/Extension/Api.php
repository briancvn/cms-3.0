<?php

namespace CMS\Infrastructure\Extension;

use CMS\Infrastructure\Constant\Services;

class Api extends \Phalcon\Mvc\Micro
{
    public function attach($middleware)
    {
        if (!$this->getEventsManager()) {
            $this->setEventsManager($this->getDI()->get(Services::EVENTS_MANAGER));
        }

        $this->getEventsManager()->attach('micro', $middleware);

        return $this;
    }
}
