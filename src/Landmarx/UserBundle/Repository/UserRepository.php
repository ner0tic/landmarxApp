<?php
namespace Landmarx\UserBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

class UserRepository extends DocumentRepository
{
    public function findAllOrderedByLastname()
    {
        return $this->createQueryBuilder()
            ->sort('lastname', 'ASC')
            ->getQuery()
            ->execute();
    }

    public function findBySlug($slug)
    {
        return $this->createQueryBuilder()
            ->field('slug')
            ->equals($slug)
            ->getQuery()
            ->execute();
    }
}
