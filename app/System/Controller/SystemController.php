<?php

namespace CMS\System\Controller;

use CMS\Infrastructure\Controller\ApiController;

class SystemController extends ApiController
{
    public function GetSettings()
    {
        return $this->config->get('externals')->client;
    }
}
