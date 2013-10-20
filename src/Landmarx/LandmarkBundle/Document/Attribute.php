<?php
namespace Landmarx\LandmarkBundle\Document;

use Landmarx\LandmarkBundle\Document\AttributeInterface;
use Landmarx\UserBundle\Document\BlameableInterface;
use Landmarx\LandmarkBundle\Traits\AttributeTrait;
use Landmarx\UserBundle\Traits\TimestampableTrait;
use Landmarx\UserBundle\Traits\BlameableTrait;
use Landmarx\LandmarkBundle\Repository\AttributeRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ODM\Document(repositoryClass="AttributeRepository")
 */
abstract class Attribute implements AttributeInterface, BlameableInterface
{
    use AttributeTrait;
    use TimestampableTrait;
    use BlameableTrait;
}
