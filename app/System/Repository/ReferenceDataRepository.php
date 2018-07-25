<?php
namespace CMS\System\Repository;

use CMS\Infrastructure\Repository\BaseRepository;

class ReferenceDataRepository extends BaseRepository {
    public function getReferenceDataList(array $kinds)
    {
        return $this->createQueryBuilder()
            ->field('Kind')
            ->in($kinds)
            ->eagerCursor(true)
            ->getQuery()
            ->execute();
    }
}