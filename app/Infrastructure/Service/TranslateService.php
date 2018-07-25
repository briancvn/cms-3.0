<?php
namespace CMS\Infrastructure\Service;

use CMS\Infrastructure\Extension\Utils;
use CMS\Infrastructure\Constant\CommonConstants;
use CMS\Infrastructure\Contract\ResourceRequestDto;

class TranslateService extends BaseService
{
    /** @var ResourceService */
    private $resourceService;

    public function __construct(ResourceService $resourceService) {
        $this->resourceService = $resourceService;
    }

    protected function translate(string $key, $resource = CommonConstants::DEFAULT_RESOURCE): string
    {
        $session = $this->authManager->getSession();
        $language = $session ? $session->getUser()->Profile->Language : CommonConstants::DEFAULT_LANGUAGE;
        $resourceResult = $this->resourceService->getResources(new ResourceRequestDto([
            Language => $language,
            Resources => [$resource]
        ]));
        return Utils::getDeepValue($resourceResult->Resources[$resource], $key);
    }
}
