<?php
namespace CMS\Infrastructure\Extension\Mapper;

use AutoMapperPlus\AutoMapperInterface;
use Underscore\Types\Strings;

use CMS\Infrastructure\Extension\Utils;
use CMS\Infrastructure\Contract\ProfileDto;

class Manager extends \AutoMapperPlus\AutoMapper {
    public static function initialize(callable $configurator): AutoMapperInterface
    {
        $mapper = new static;
        $configurator($mapper->getConfiguration(), $mapper);
        $configuration = $mapper->getConfiguration();
        $configuration->registerMapping('__PHP_Incomplete_Class', ProfileDto::class);
        foreach (Utils::scanNamespaces(CONTRACT_NAMESPACE, CONTRACT_DIR) as $dtoName) {
            if (Strings::endsWith($dtoName, 'RequestDto')) {
                $configuration->registerMapping(\stdClass::class, $dtoName);
            } else if (Strings::endsWith($dtoName, 'CriteriaDto')) {
                $configuration->registerMapping(\stdClass::class, $dtoName);
            }

        }
        return $mapper;
    }

    public function map($source, string $destinationClass)
    {
        return $source ? parent::map($source, $destinationClass) : $source;
    }
}
