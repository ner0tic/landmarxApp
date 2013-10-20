<?php
namespace Landmarx\LandmarkBundle\Traits;

use Landmarx\LandmarkBundle\Document\Category;

trait CategoryTrait
{
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
     * @param boolean $public
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
     * @return boolean
     */
    public function isPublic()
    {
        return (bool) $this->public;
    }
}
