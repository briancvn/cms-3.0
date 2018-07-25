<?php
namespace CMS\Infrastructure\Repository;

use CMS\Infrastructure\Domain\SearchCriteria;
use CMS\Infrastructure\Domain\SearchResult;

class BaseRepository extends \Doctrine\ODM\MongoDB\DocumentRepository {
    public function Search(SearchCriteria $criteria): SearchResult
    {
        $query = $this->createQueryBuilder();
        if (isset($criteria->Sort)) {
            $query->sort($criteria->Sort->Field, $criteria->Sort->Dir);
        }

        $total = $query
            ->count()
            ->getQuery()
            ->execute();
        $results = $query
            ->find()
            ->limit($criteria->Limit)
            ->skip($criteria->Skip)
            ->getQuery()
            ->execute();
        return new SearchResult([
            Results => $results->toArray(),
            Total => $total
        ]);
    }

    public function FindById(string $id)
    {
        return $this->find($id);
    }
}