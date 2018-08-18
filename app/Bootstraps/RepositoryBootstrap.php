<?php

namespace CMS\Bootstraps;

use CMS\BootstrapInterface;
use CMS\Infrastructure\Extension\Api;
use CMS\Infrastructure\Extension\Utils;
use CMS\Infrastructure\Constant\Services;

class RepositoryBootstrap implements BootstrapInterface
{
    public function run(\Phalcon\DiInterface $di, \Phalcon\Config $config, Api $api = null)
    {
        foreach (Utils::scanNamespaces(DOMAIN_NAMESPACE, DOMAIN_DIR) as $domain) {
            $arguments = [];
            $annotationReader = new \Doctrine\Common\Annotations\AnnotationReader();
            $reflectionClass = new \ReflectionClass($domain);
            $classAnnotations = $annotationReader->getClassAnnotations($reflectionClass);
            $annotation = Utils::array_find($classAnnotations, function($item) {
                return !empty($item->repositoryClass);
            });

            if ($annotation) {
                $di->set($annotation->repositoryClass, function () use ($di, $domain) {
                    return $di->get(Services::DOCUMENT_MANAGER)->getRepository($domain);
                });
            }
        }
    }
}
