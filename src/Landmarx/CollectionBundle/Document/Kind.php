<?php
namespace Landmarx\CollectionBundle\Document;

use Landmarx\CollectionBundle\Traits\KindTrait;
use Landmarx\CollectionBundle\Traits\KindInterface;
use Landmarx\CollectionBundle\Repository\KindRepository;
use Landmarx\UserBundle\Traits\SluggableTrait;
use Landmarx\UserBundle\Traits\SluggableInterface;
use Landmarx\UserBundle\Traits\TimestampableTrait;
use Landmarx\UserBundle\Traits\TimestampableInterface;
use Landmarx\UserBundle\Traits\BlameableTrait;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ODM\Document(repositoryClass="KindRepository")
 */
abstract class Kind implements KindInterface, BlameableInterface, SluggableInterface
{
    use KindTrait;
    use SluggableTrait;
    use TimestampableTrait;
    use BlameableTrait;
}
