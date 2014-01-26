<?php
namespace Landmarx\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;
use Oh\GoogleMapFormTypeBundle\Validator\Constraints as OhAssert;
use Gedmo\Mapping\Annotation as Gedmo;

use Landmarx\UserBundle\Repository\UserRepository;
use Landmarx\UtilityBundle\Traits\TimestampableTrait;
use Landmarx\UtilityBundle\Traits\GeolocatableTrait;

/**
 * @ODM\Document(repositoryClass="UserRepository")
 */
abstract class User
{
    use TimestampableTrait;

    /**
     * @var integer $id
     *
     * @ODM\Id
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ODM\String
     * @Assert\NotBlank(message="Please enter your first name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min="3",
     *     minMessage="The name is too short.",
     *     groups={"Registration", "Profile"},
     *     max="255",
     *     maxMessage="The name is too long."
     *)
     */
    protected $firstname;

    /**
     * @ODM\String
     * @Assert\NotBlank(message="Please enter your last name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min="3",
     *     minMessage="The name is too short.",
     *     groups={"Registration", "Profile"},
     *     max="255",
     *     maxMessage="The name is too long."
     *)
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ODM\String
     */
    protected $facebookId = null;

    /**
     * @var string
     *
     * @ODM\String
     */
    protected $googleId = null;

    /**
     * @var string
     *
     * @ODM\String
     */
    protected $linkedinId = null;

    /**
     * @var string
     *
     * @ODM\String
     */
    protected $twitterId = null;

    /**
     * @var string
     *
     * @ODM\String
     */
    protected $foursquareId = null;

    /**
     * @ODM\String
     * @Assert\Url
     */
    protected $url = null;

    /**
     * @ODM\String
     */
    protected $bio = null;

    /**
     * @var string
     *
     * @ODM\String
     */
    protected $avatar = '/bundles/pmsuser/img/avatars/default.png';

    /**
    * @Gedmo\Slug(fields={"lastname", "firstname"})
    * @ODM\string
    */
    protected $slug;

    /**
     * Get slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     */
    public function setSlug($slug = null)
    {
        if (null == $slug) {
            $this->slug = str_replace(
                ' ',
                '-',
                $this->getName()
            );
        }

        return $this;
    }

    public function getName()
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * Get the full name of the user (first + last name)
     * @return string
     */
    public function getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getLastname();
    }

    /**
     * @param string $facebookId
     * @return void
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
        $this->setUsername($facebookId);
        $this->salt = '';
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param Array
     */
    public function setFBData($fbdata)
    {
        if (isset($fbdata['id'])) {
            $this->setFacebookId($fbdata['id']);
            $this->addRole('ROLE_FACEBOOK');
        }
        if (isset($fbdata['first_name'])) {
            $this->setFirstname($fbdata['first_name']);
        }
        if (isset($fbdata['last_name'])) {
            $this->setLastname($fbdata['last_name']);
        }
        if (isset($fbdata['email'])) {
            $this->setEmail($fbdata['email']);
        }
    }

    /**
     * @inheritdoc
     */
    public function setFirstname($firstName)
    {
        $this->firstname = $firstName;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @inheritdoc
     */
    public function setLastname($lastname)
    {
        $this->last_name = $lastName;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set googleId
     *
     * @param string $googleId
     * @return User
     */
    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;
        return $this;
    }

    /**
     * Get googleId
     *
     * @return string
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * Set linkedinId
     *
     * @param string $linkedinId
     * @return User
     */
    public function setLinkedinId($linkedinId)
    {
        $this->linkedinId = $linkedinId;
        return $this;
    }

    /**
     * Get linkedinId
     *
     * @return string
     */
    public function getLinkedinId()
    {
        return $this->linkedinId;
    }

    /**
     * Set twitterId
     *
     * @param string $twitterId
     * @return User
     */
    public function setTwitterId($twitterId)
    {
        $this->twitterId = $twitterId;
        return $this;
    }

    /**
     * Get twitterId
     *
     * @return string
     */
    public function getTwitterId()
    {
        return $this->twitterId;
    }

    /**
     * Set foursquareId
     *
     * @param string $foursquareId
     * @return User
     */
    public function setFoursquareId($foursquareId)
    {
        $this->foursquareId = $foursquareId;
        return $this;
    }

    /**
     * Get foursquareId
     *
     * @return string
     */
    public function getFoursquareId()
    {
        return $this->foursquareId;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }
}
