<?php

namespace CMS\Bootstraps;

use CMS\BootstrapInterface;
use CMS\Infrastructure\Extension\Api;
use CMS\Infrastructure\Extension\Middleware\CorsMiddleware;
use CMS\Infrastructure\Extension\Middleware\DataTransferMiddleware;
use CMS\Infrastructure\Extension\Middleware\NotFoundMiddleware;
use CMS\Infrastructure\Extension\Middleware\AuthenticationMiddleware;

class MiddlewareBootstrap implements BootstrapInterface
{
    public function run(\Phalcon\DiInterface $di, \Phalcon\Config $config, Api $api = null)
    {
        $api->attach(new CorsMiddleware($config->cors->allowedOrigins->toArray()))
            ->attach(new DataTransferMiddleware)
            ->attach(new NotFoundMiddleware)
            ->attach(new AuthenticationMiddleware);
    }
}