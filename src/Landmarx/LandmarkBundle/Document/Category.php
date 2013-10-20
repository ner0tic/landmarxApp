<?php
namespace Landmarx\LandmarkBundle\Document;

use Landmarx\LandmarkBundle\Traits\CategoryTrait;
use Landmarx\LandmarkBundle\Document\CategoryInterface;
use Landmarx\LandmarkBundle\Repository\CategoryRepository;
use Landmarx\UserBundle\Traits\BlameableTrait;
use Landmarx\UserBundle\Document\BlameableInterface;
use Landmarx\UserBundle\Traits\SluggableTrait;
use Landmarx\UserBundle\Traits\SluggableInterface;
use Landmarx\UserBundle\Traits\TimestampableTrait;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ODM\Document(repositoryClass="CategoryRepository")
 */
abstract class Category implements CategoryInterface, BlameableInterface, SluggableInterface
{
    use CategoryTrait;
    use SluggableTrait;
    use TimestampableTrait;
    use BlameableTrait;
}
