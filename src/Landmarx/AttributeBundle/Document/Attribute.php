<?php
namespace Landmarx\AttributeBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

use Landmarx\UtilityBundle\Traits\BlameableTrait;
use Landmarx\UtilityBundle\Traits\SluggableTrait;
use Landmarx\UtilityBundle\Traits\TimestampableTrait;
use Landmarx\AttributeBundle\Traits\HasGroupsTrait;

/**
 * @ODM\Document(repositoryClass="Landmarx\AttributeBundle\Repository\AttributeRepository")
 */
class Attribute
{
    use SluggableTrait;
    use TimestampableTrait;
    use BlameableTrait;
    use HasGroupsTrait;

    /**
     * Attribute id
     * @var integer
     * @ODM\Id
     */
    protected $id;

    /**
     * Attribute name
     * @var string
     * @ODM\String
     */
    protected $name = null;

    /**
     * Attribute description
     * @var string Attribute description
     * @ODM\String
     */
    protected $description = null;

    /**
     * Attribute type
     * @var Type
     * @ODM\ReferenceOne(targetDocument="Type")
     */
    protected $type;

    /**
     * Attribute
     * @var Landmarx\AttributeBundle\Document\Attribute
     * @ODM\ReferenceOne(targetDocument="Attribute")
     */
    protected $parent = null;

    /**
     * Get Attribute id
     * @return integer Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Attribute name
     * @return string Attribute name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get description
     * @return string Attribute description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get Attribute type
     * @return Landmarx\AttributeBundle\Document\Type Attribute type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get parent Attribute
     * @return Attribute Parent Attribute
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set Attribute name
     * @param string $name Attribute name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set Attribute description
     * @param string $desc Attribute description
     */
    public function setDescription($desc)
    {
        $this->description = $desc;

        return $this;
    }

    /**
     * Set Attribute type
     * @param Landmarx\AttributeBundle\Document\Type $type Attribute type
     */
    public function setType(Type $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set parent Attribute
     * @param Attribute $parent Parent Attribute
     */
    public function setParent(Attribute $parent)
    {
        $this->parent = $parent;

        return $this;
    }
}
