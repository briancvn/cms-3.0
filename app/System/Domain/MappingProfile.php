<?php
namespace CMS\System\Domain;

use AutoMapperPlus\Configuration\AutoMapperConfig;

use CMS\System\Domain\ReferenceData;
use CMS\System\Contract\ReferenceDataDto;
use CMS\Infrastructure\Extension\Mapper\Manager as MapperManager;

class MappingProfile
{
    public static function mappingConfig(AutoMapperConfig $mapperConfig, MapperManager $mapper)
    {
        $mapperConfig->registerMapping(ReferenceData::class, ReferenceDataDto::class)->reverseMap();
    }
}