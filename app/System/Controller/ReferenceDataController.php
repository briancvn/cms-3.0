<?php

namespace CMS\System\Controller;

use CMS\Infrastructure\Controller\ApiController;
use CMS\System\Service\ReferenceDataService;
use CMS\System\Contract\ReferenceDataCollectionRequestDto;
use CMS\System\Contract\ReferenceDataCollectionResultDto;

class ReferenceDataController extends ApiController
{
    /** @var ReferenceDataService */
    private $referenceDataService;

    public function __construct(ReferenceDataService $referenceDataService)
    {
        parent::__construct();
        $this->referenceDataService = $referenceDataService;
    }

    /** @Post */
    public function GetReferenceDataList(ReferenceDataCollectionRequestDto $requestDto): ReferenceDataCollectionResultDto
    {
        return $this->referenceDataService->getReferenceDataList($requestDto);
    }
}
