<?php
namespace CMS\Infrastructure\Service;

use Phalcon\Annotations\Adapter\Memory as MemoryAnnAdaptor;
use Underscore\Types\Arrays;

use CMS\Infrastructure\Extension\Auth\Manager as AuthManager;
use CMS\Infrastructure\Extension\Mapper\Manager as MapperManager;
use CMS\Infrastructure\Extension\Exception\WarningException;
use CMS\Infrastructure\Constant\AnnotationConstants;
use CMS\Infrastructure\Constant\ErrorCodes;
use CMS\Infrastructure\Constant\ValidationMessageConstants;

abstract class BaseService
{
    /** @var AuthManager */
    protected $authManager;

    /** @var MapperManager */
    protected $mapper;

    public function setAuthManager(AuthManager $authManager) {
        $this->authManager = $authManager;
    }

    public function setMapper(MapperManager $mapper) {
        $this->mapper = $mapper;
    }

    public function __call($name, $arguments)
    {
        $reader = new MemoryAnnAdaptor();
        $reflector = $reader->get($this);
        $methodsAnnotations = $reflector->getMethodsAnnotations();
        if (!empty($methodsAnnotations[$name])) {
            $annotation = Arrays::find($methodsAnnotations[$name]->getAnnotations(), function($annotation) {
                return $annotation->getName() === AnnotationConstants::ACCESS_ROLES;
            });

            if ($annotation && !$this->authManager->isValidBusinessItems($annotation->getArguments())) {
                throw new WarningException(ErrorCodes::NOT_ACCEPTABLE, ValidationMessageConstants::NOT_PERMISSION);
            }
        }

        return call_user_func_array([$this, $name], $arguments);
    }
}