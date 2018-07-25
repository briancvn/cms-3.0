<?php

namespace CMS\Infrastructure\Controller;

use CMS\Infrastructure\Service\ResourceService;
use CMS\Infrastructure\Contract\ResourceRequestDto;
use CMS\Infrastructure\Contract\ResourceResultDto;

class ResourceController extends ApiController
{
    /** @var ResourceService */
    private $resourceService;

    public function __construct(ResourceService $resourceService)
    {
        parent::__construct();
        $this->resourceService = $resourceService;
    }

    /** @Post */
    public function GetResources(ResourceRequestDto $requestDto): ResourceResultDto
    {
        return $this->resourceService->getResources($requestDto);
    }
}
