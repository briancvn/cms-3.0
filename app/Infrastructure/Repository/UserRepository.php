<?php
namespace CMS\Infrastructure\Repository;

class UserRepository extends BaseRepository {
    public function findOneByAuthRequest(string $username)
    {
        $qb = $this->createQueryBuilder();
        return $qb->addOr($qb->expr()->field('Username')->equals($username))
            ->addOr($qb->expr()->field('Email')->equals($username))
            ->addOr($qb->expr()->field('Pin')->equals((int)$username))
            ->getQuery()
            ->getSingleResult();
    }
}