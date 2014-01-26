<?php
namespace Landmarx\CollectionBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

use Landmarx\CollectionBundle\Traits\CollectionTrait;
use Landmarx\CollectionBundle\Repository\CollectionRepository;
use Landmarx\LandmarkBundle\Document\Landmark;
use Landmarx\UtilityBundle\Traits\BlameableTrait;
use Landmarx\UtilityBundle\Traits\SluggableTrait;
use Landmarx\UtilityBundle\Traits\TimestampableTrait;

/**
 * @ODM\Document(repositoryClass="CollectionRepository")
 */
abstract class Collection
{
    use TimestampableTrait;
    use BlameableTrait;
    use SluggableTrait;

     /**
     * id
     * @var integer
     * @ODM\Id
     */
    protected $id;

    /**
     * Get id
     * @return integer Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     * @param integer $id Id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Name
     * @var string
     * @ODM\String
     */
    protected $name = null;

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Description
     * @var string
     * @ODM\String
     */
    protected $description = null;

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @inheritdoc
     */
    public function setDescription($desc)
    {
        $this->description = $desc;

        return $this;
    }

    /**
     * Type
     * @var Type
     * @ODM\ReferenceOne(targetDocument="Type")
     */
    protected $type;

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type
     * @param Landmarx\CollectionBundle\Document\Type $type Type
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Attributes
     * @var array
     * @ODM\ReferenceMany(targetDocument="Attribute")
     */
    protected $attributes = array();

    /**
     * @inheritdoc
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @inheritdoc
     */
    public function getAttribute($attribute)
    {
        if (is_object($this->attributes[$attribute])) {
            return $this->attributes[$attribute];
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function setAttributes(Array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setattribute($attribute)
    {
        if (is_object($attribute)) {
            $this->attributes[] = $attribute;

            return $this;
        }

        return false;
    }

    protected $landmarks = array();

    public function getLandmarks()
    {
        return $this->landmarks;
    }

    public function getLandmark($landmark)
    {
        return $this->landmarks[$landmark];
    }

    public function setLandmarks(array $landmarks)
    {
        $this->landmarks = $landmarks;

        return $this;
    }

    public function addLandmark(Landmark $landmark)
    {
        $this->landmarks[] = $landmark;

        return $this;
    }

    public function hasLandmark($landmark)
    {
        return $this->landmarks[$landmark];
    }

    public function removeLandmark(Landmark $landmark)
    {
        unset($this->landmarks[$landmark]);
    }
}
