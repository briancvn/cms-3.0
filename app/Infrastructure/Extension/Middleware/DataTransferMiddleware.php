<?php

namespace CMS\Infrastructure\Extension\Middleware;

use CMS\Infrastructure\Extension\Mvc\Plugin;
use CMS\Infrastructure\Constant\HttpMethods;

class DataTransferMiddleware extends Plugin implements \Phalcon\Mvc\Micro\MiddlewareInterface
{
    public function beforeExecuteRoute()
    {
        $router = $this->getDi()->getRouter()->getMatchedRoute();
        $param = [
            'action' => $router->getName(),
            'httpMethods' => $router->getHttpMethods()
        ];

        $request = $this->getDi()->getRequest();
        if ($router->getHttpMethods() === HttpMethods::GET) {
            $param['param'] = $request->getPostedData();
        } else if ($router->getHttpMethods() === HttpMethods::POST) {
            $param['param'] = json_decode($request->getRawBody());
        }

        $dispatcher = $this->getDi()->getDispatcher();
        $dispatcher->setParams($param);
    }

    public function call(\Phalcon\Mvc\Micro $api)
    {
        return true;
    }
}