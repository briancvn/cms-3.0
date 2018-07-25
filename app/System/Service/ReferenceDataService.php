<?php

namespace CMS\System\Service;

use CMS\Infrastructure\Service\BaseService;
use CMS\System\Repository\ReferenceDataRepository;
use CMS\System\Contract\ReferenceDataCollectionRequestDto;
use CMS\System\Contract\ReferenceDataCollectionResultDto;
use CMS\System\Contract\ReferenceDataDto;

class ReferenceDataService extends BaseService
{
    /** @var ReferenceDataRepository */
    private $referenceDataRepository;

    public function __construct(ReferenceDataRepository $referenceDataRepository) {
        $this->referenceDataRepository = $referenceDataRepository;
    }

    protected function getReferenceDataList(ReferenceDataCollectionRequestDto $requestDto): ReferenceDataCollectionResultDto
    {
        $results = $this->referenceDataRepository->getReferenceDataList(array_map(function($kind) {
            return EReferenceDataKind[$kind];
        }, $requestDto->Kinds));
        return new ReferenceDataCollectionResultDto([
            Results => $this->mapper->mapMultiple($results->toArray(), ReferenceDataDto::class)
        ]);
    }
}
