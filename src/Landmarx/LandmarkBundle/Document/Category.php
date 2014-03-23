<?php
namespace Landmarx\LandmarkBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

use Landmarx\UtilityBundle\Traits\BlameableTrait;
use Landmarx\UtilityBundle\Traits\SluggableTrait;
use Landmarx\UtilityBundle\Traits\TimestampableTrait;

/**
 * @ODM\Document(repositoryClass="Landmarx\LandmarkBundle\Repository\CategoryRepository")
 */
class Category
{
    use SluggableTrait;
    use TimestampableTrait;
    use BlameableTrait;

    /**
     * Landmark category id
     * @var integer
     * @ODM\Id
     */
    protected $id;

    /**
     * Get category id
     * @return integer Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set category id
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
     * Landmark category
     * @var Category
     * @ODM\ReferenceOne(targetDocument="Category")
     */
    protected $parent = null;

    /**
     * Get parent landmark category
     * @return Category Parent landmark category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set parent landmark category
     * @param Category $parent Parent
     */
    public function setParent(Category $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @ODM\Boolean
     */
    protected $public = true;

    /**
     * Set public
     *
     * @param bool $public
     * @return Category
     */
    public function setPublic($public = true)
    {
        $this->public = $public;
        return $this;
    }

    /**
     * Is public
     *
     * @return bool
     */
    public function isPublic($public = null)
    {
        if (null != $public && is_bool($public)) {
            $this->public = $oublic;

            return $this;
        }
        return (bool) $this->public;
    }
}
