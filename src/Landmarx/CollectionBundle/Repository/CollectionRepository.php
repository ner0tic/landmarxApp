<?php
namespace Landmarx\CollectionBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

class CollectionRepository extends DocumentRepository
{
    public function findAllOrderedByLastname()
    {
        return $this->createQueryBuilder()
            ->sort('name', 'ASC')
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

