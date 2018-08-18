<?php

namespace CMS\Bootstraps;

use CMS\BootstrapInterface;
use CMS\Infrastructure\Extension\Api;
use CMS\Infrastructure\Extension\Templating\Control\Form;
use CMS\Infrastructure\Extension\Templating\Control\Indicator;
use CMS\Infrastructure\Extension\Templating\Control\Navigation;

class ControlBootstrap implements BootstrapInterface
{
    public function run(\Phalcon\DiInterface $di, \Phalcon\Config $config, Api $api = null)
    {
        $di->setShared('form', function () {
            return new Form;
        });
        $di->setShared('indicator', function () {
            return new Indicator;
        });
        $di->setShared('navigation', function () {
            return new Navigation;
        });
    }
}
