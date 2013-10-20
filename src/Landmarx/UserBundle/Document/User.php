<?php
namespace Landmarx\UserBundle\Document;

use Landmarx\UserBundle\Traits\UserTrait;
use Landmarx\UserBundle\Document\UserInterface;
use Landmarx\UserBundle\Repository\UserRepository;
use Landmarx\UserBundle\Traits\TimestampableTrait;
use Landmarx\UserBundle\Traits\GeolocatableTrait;
use Landmarx\UserBundle\Document\GeolocatableInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;
use Oh\GoogleMapFormTypeBundle\Validator\Constraints as OhAssert;

/**
 * @ODM\Document(repositoryClass="UserRepository")
 */
abstract class User implements UserInterface, GeolocatableInterface
{
    use UserTrait;
    use GeolocatableTrait;
    use TimestampableTrait;
}
