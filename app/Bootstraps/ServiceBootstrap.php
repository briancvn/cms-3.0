<?php

namespace CMS\Bootstraps;

use CMS\BootstrapInterface;
use CMS\Infrastructure\Extension\Api;
use CMS\Infrastructure\Extension\Utils;
use CMS\Infrastructure\Extension\Auth\Manager as AuthManager;
use CMS\Infrastructure\Extension\Mapper\Manager as MapperManager;

class ServiceBootstrap implements BootstrapInterface
{
    public function run(Api $api, \Phalcon\DiInterface $di, \Phalcon\Config $config)
    {
        foreach (Utils::scanNamespaces(SERVICE_NAMESPACE, SERVICE_DIR) as $serviceName) {
            $arguments = [];
            $classRef = new \ReflectionClass($serviceName);
            $constructor = $classRef->getConstructor();
            if ($constructor) {
                $parameters = $constructor->getParameters();
                foreach ($parameters as $param) {
                    array_push($arguments, [
                        "type" => "service",
                        'name' => $param->getClass()->name
                    ]);
                }
            }

            $di->set($serviceName, [
                'className' => $serviceName,
                'arguments' => $arguments,
                "calls" => [
                    [
                        "method"    => "setAuthManager",
                        "arguments" => [
                            [
                                "type"  => "service",
                                "name" => AuthManager::class
                            ]
                        ]
                    ],
                    [
                        "method"    => "setMapper",
                        "arguments" => [
                            [
                                "type"  => "service",
                                "name" => MapperManager::class
                            ]
                        ]
                    ]
                ]
            ]);
        }
    }
}
