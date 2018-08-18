<?php

namespace CMS;

use CMS\Infrastructure\Extension\Api;

interface BootstrapInterface {
    public function run(\Phalcon\DiInterface $di, \Phalcon\Config $config, Api $api = null);
}