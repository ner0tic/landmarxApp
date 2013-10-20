<?php
namespace Landmarx\LandmarkBundle\Document;

use Landmarx\LandmarkBundle\Traits\LandmarkTrait;
use Landmarx\LandmarkBundle\Document\LandmarkInterface;
use Landmarx\LandmarkBundle\Repository\LandmarkRepository;
use Landmarx\UserBundle\Traits\BlameableTrait;
use Landmarx\UserBundle\Document\BlameableInterface;
use Landmarx\UserBundle\Traits\GeolocatableTrait;
use Landmarx\UserBundle\Traits\GeolocatableTraitInterface;
use Landmarx\UserBundle\Traits\SluggableTrait;
use Landmarx\UserBundle\Traits\SluggableInterface;
use Landmarx\UserBundle\Traits\TimestampableTrait;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;
use Oh\GoogleMapFormTypeBundle\Validator\Constraints as OhAssert;

/**
 * @ODM\Document(repositoryClass="LandmarkRepository")
 */
abstract class Landmark implements LandmarkInterface, GeolocatableInterface, BlameableInterface, SluggableInterface
{
    use LandmarkTrait;
    use GeolocatableTrait;
    use SluggableTrait;
    use TimestampableTrait;
    use BlameableTrait;
}
