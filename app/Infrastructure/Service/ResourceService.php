<?php
namespace CMS\Infrastructure\Service;

use CMS\Infrastructure\Contract\ResourceRequestDto;
use CMS\Infrastructure\Contract\ResourceResultDto;

class ResourceService extends BaseService
{
    protected function getResources(ResourceRequestDto $requestDto): ResourceResultDto
    {
        $resources = null;
        foreach ($requestDto->Resources as $resource) {
            $resourceContent = file_get_contents(RESOURCE_DIR.'/'.$resource.'/'.$requestDto->Language.'.json');
            if ($resourceContent) {
                $resources[$resource] = json_decode($resourceContent, true);
            } else {
                $resources[$resource] = json_decode(file_get_contents(INFRASTRUCTURE_RESOURCE_DIR.'/'.$resource.'/'.$requestDto->Language.'.json'), true);
            }
        }

        return new ResourceResultDto([
            Resources => $resources
        ]);
    }
}
