<?php
namespace Landmarx\AttributeBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

use Landmarx\UtilityBundle\Traits\SluggableTrait;
use Landmarx\UtilityBundle\Traits\TimestampableTrait;
use Landmarx\AttributeBundle\Traits\HasAttributesTrait;

/**
 * @ODM\Document(repositoryClass="Landmarx\AttributeBundle\Repository\GroupRepository")
 */
class Group
{
	use SluggableTrait;
    use TimestampableTrait;
    use HasAttributesTrait;

	/**
     * Group id
     * @var integer
     * @ODM\Id
     */
    protected $id;

    /**
     * Group name
     * @var string
     * @ODM\String
     */
    protected $name = null;

    /**
     * Group description
     * @var string Group description
     * @ODM\String
     */
    protected $description = null;

    /**
     * Get Group id
     * @return integer Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Group name
     * @return string Group name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get description
     * @return string Group description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set Group name
     * @param string $name Group name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set Group description
     * @param string $desc Group description
     */
    public function setDescription($desc)
    {
        $this->description = $desc;

        return $this;
    }
}
