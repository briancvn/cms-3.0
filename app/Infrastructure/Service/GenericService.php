<?php
namespace CMS\Infrastructure\Service;

use CMS\Infrastructure\Repository\BaseRepository;
use CMS\Infrastructure\Domain\SearchCriteria;
use CMS\Infrastructure\Contract\SearchCriteriaDto;
use CMS\Infrastructure\Contract\SearchResultDto;

abstract class GenericService extends BaseService
{
    /** @var BaseRepository */
    protected $repository;

    protected $dtoSearchType;
    protected $dtoDetailType;

    public function __construct(BaseRepository $repository, $dtoSearchType, $dtoDetailType) {
        $this->repository = $repository;
        $this->dtoSearchType = $dtoSearchType;
        $this->dtoDetailType = $dtoDetailType;
    }

    public function Search(SearchCriteriaDto $criteria): SearchResultDto
    {
        $searchResult = $this->repository->Search($this->mapper->map($criteria, SearchCriteria::class));
        return new SearchResultDto([
            Results => $this->mapper->mapMultiple($searchResult->Results, $this->dtoSearchType),
            Total => $searchResult->Total
        ]);
    }

    public function FindById(string $id)
    {
        return $this->mapper->map($this->repository->FindById($id), $this->dtoDetailType);
    }
}
