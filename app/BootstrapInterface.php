<?php

namespace CMS;

use CMS\Infrastructure\Extension\Api;

interface BootstrapInterface {
    public function run(Api $api, \Phalcon\DiInterface $di, \Phalcon\Config $config);
}