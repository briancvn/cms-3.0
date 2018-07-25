<?php
namespace CMS\Infrastructure\Domain;

use AutoMapperPlus\Configuration\AutoMapperConfig;

use CMS\Infrastructure\Extension\Mapper\Manager as MapperManager;
use CMS\Infrastructure\Domain\Profile;
use CMS\Infrastructure\Contract\UserDto;
use CMS\Infrastructure\Contract\UserSearchResultDto;
use CMS\Infrastructure\Contract\ProfileDto;
use CMS\Infrastructure\Contract\SearchCriteriaDto;
use CMS\Infrastructure\Contract\SearchResultDto;
use CMS\Infrastructure\Domain\SearchCriteria;
use CMS\Infrastructure\Domain\SearchResult;

class MappingProfile
{
    public static function mappingConfig(AutoMapperConfig $mapperConfig, MapperManager $mapper)
    {
        $mapperConfig->registerMapping(User::class, UserDto::class)->reverseMap();
        $mapperConfig->registerMapping(User::class, UserSearchResultDto::class);
        $mapperConfig->registerMapping(User::class, User::class)
            ->forMember('Profile', function (User $source) use($mapper) {
                return $mapper->map($source->Profile, Profile::class);
            });
        $mapperConfig->registerMapping('Proxies\\__CG__\\'.Profile::class, Profile::class);
        $mapperConfig->registerMapping(Profile::class, ProfileDto::class)->reverseMap();
                $mapperConfig->registerMapping(SearchCriteriaDto::class, SearchCriteria::class);
        $mapperConfig->registerMapping(SearchResult::class, SearchResultDto::class);
    }
}