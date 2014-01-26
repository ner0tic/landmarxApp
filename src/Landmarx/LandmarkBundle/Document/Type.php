<?php
namespace Landmarx\LandmarkBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

use Landmarx\LandmarkBundle\Traits\TypeTrait;
use Landmarx\LandmarkBundle\Repository\TypeRepository;
use Landmarx\UtilityBundle\Traits\SluggableTrait;
use Landmarx\UtilityBundle\Traits\TimestampableTrait;
use Landmarx\UtilityBundle\Traits\BlameableTrait;

/**
 * @ODM\Document(repositoryClass="TypeRepository")
 */
class Type
{
    use SluggableTrait;
    use TimestampableTrait;
    use BlameableTrait;

    /**
     * Type id
     * @var integer
     * @ODM\Id
     */
    protected $id;

    /**
     * Get type id
     * @return integer Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type id
     * @param integer $id Id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
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
     * Type parent
     * @var Type $parent
     * @ODM\ReferenceOne(targetDocument="Type")
     */
    protected $parent = null;

    /**
     * Get type parent
     * @return Type type parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set type parent
     * @param Type $parent type parent
     */
    public function setParent(Type $parent)
    {
        $this->parent = $parent;

        return $this;
    }
}
