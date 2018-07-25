<?php
namespace CMS\Infrastructure\Extension;

use CMS\Infrastructure\Constant\Services;

class FactoryDefault extends \Phalcon\Di\FactoryDefault
{
    public function __construct()
    {
        parent::__construct();

        $this->setShared(Services::REQUEST, new Http\Request);
        $this->setShared(Services::RESPONSE, new Http\Response);
    }
}
