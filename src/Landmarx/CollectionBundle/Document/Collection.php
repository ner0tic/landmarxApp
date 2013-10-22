<?php
namespace Landmarx\CollectionBundle\Document;

use Landmarx\CollectionBundle\Traits\CollectionTrait;
use Landmarx\CollectionBundle\Document\CollectionInterface;
use Landmarx\UserBundle\Traits\BlameableTrait;
use Landmarx\UserBundle\Document\BlameableInterface;
use Landmarx\UserBundle\Traits\SluggableTrait;
use Landmarx\UserBundle\Document\SluggableInterface;
use Landmarx\UserBundle\Traits\TimestampableTrait;
use Landmarx\CollectionBundle\Repository\CollectionRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ODM\Document(repositoryClass="CollectionRepository")
 */
abstract class Collection implements CollectionInterface, BlameableInterface, SluggableInterface
{
    use CollectionTrait;
    use TimestampableTrait;
    use BlameableTrait;
    use SluggableTrait;
}
