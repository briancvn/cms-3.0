<?php

namespace CMS\Bootstraps;

use CMS\BootstrapInterface;
use CMS\Infrastructure\Extension\Route;
use CMS\Infrastructure\Extension\Api;

class RouterBootstrap implements BootstrapInterface
{
    public function run(Api $api, \Phalcon\DiInterface $di, \Phalcon\Config $config)
    {
        // Create the micro route annotation object, passing the micro app into the constructor
        $route = new Route($api, $di);

        // Add a directory of "controllers" that are namespaced
        $route->addControllerNamespace(CONTROLLER_NAMESPACE, CONTROLLER_DIR);

        // Add the rotues to our micro app
        $route->mount();
    }
}
