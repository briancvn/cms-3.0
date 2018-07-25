<?php

namespace CMS\Infrastructure\Extension\Middleware;

use CMS\Infrastructure\Extension\Mvc\Plugin;
use CMS\Infrastructure\Extension\Exception\Exception;
use CMS\Infrastructure\Constant\ErrorCodes;

class NotFoundMiddleware extends Plugin implements \Phalcon\Mvc\Micro\MiddlewareInterface
{
    public function beforeNotFound()
    {
        throw new Exception(ErrorCodes::GENERAL_NOT_FOUND);
    }

    public function call(\Phalcon\Mvc\Micro $api) {
        return true;
    }
}
