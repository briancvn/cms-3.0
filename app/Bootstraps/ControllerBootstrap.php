<?php

namespace CMS\Bootstraps;

use CMS\BootstrapInterface;
use CMS\Infrastructure\Extension\Api;
use CMS\Infrastructure\Extension\Utils;
use CMS\Infrastructure\Extension\Mapper\Manager as MapperManager;
use CMS\Infrastructure\Extension\Cache\Manager as CacheManager;
use CMS\Infrastructure\Constant\Services;
use CMS\Infrastructure\Controller\ApiController;

class ControllerBootstrap implements BootstrapInterface
{
    public function run(Api $api, \Phalcon\DiInterface $di, \Phalcon\Config $config)
    {
        foreach (Utils::scanNamespaces(CONTROLLER_NAMESPACE, CONTROLLER_DIR) as $ctrlName) {
            $arguments = [];
            $classRef = new \ReflectionClass($ctrlName);
            if ($classRef->getParentClass()->getName() != ApiController::class) {
                continue;
            }

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

            $di->set($ctrlName, [
                'className' => $ctrlName,
                'arguments' => $arguments,
                "calls" => [
                    [
                        "method"    => "setConfig",
                        "arguments" => [
                            [
                                "type"  => "service",
                                "name" => Services::CONFIG
                            ]
                        ]
                    ],
                    [
                        "method"    => "setDispatcher",
                        "arguments" => [
                            [
                                "type"  => "service",
                                "name" => Services::DISPATCHER
                            ]
                        ]
                    ],
                    [
                        "method"    => "setCache",
                        "arguments" => [
                            [
                                "type"  => "service",
                                "name" => CacheManager::class
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