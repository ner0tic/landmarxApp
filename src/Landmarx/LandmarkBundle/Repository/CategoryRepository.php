<?php
namespace Landmarx\LandmarkBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

class CategoryRepository extends DocumentRepository
{
    public function findAllOrderedByName()
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
