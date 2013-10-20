<?php
namespace Landmarx\LandmarkBundle\Traits;

use Landmarx\LandmarkBundle\Document\Kind;
use Landmarx\LandmarkBundle\Document\Category;
use Landmarx\LandmarkBundle\Document\Attribute;

trait LandmarkTrait
{
    /**
     * Landmark id
     * @var integer
     * @ODM\Id
     */
    protected $id;

    /**
     * Get landmark id
     * @return integer Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set landmark id
     * @param integer $id Id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Landmark name
     * @var string
     * @ODM\String
     */
    protected $name = null;

    /**
     * Get landmark name
     * @return string Landmark name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set landmark name
     * @param string $name Landmark name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Landmark description
     * @var string Landmark description
     * @ODM\String
     */
    protected $description = null;

    /**
     * Get description
     * @return string Landmark description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set landmark description
     * @param string $desc Landmark description
     */
    public function setDescription($desc)
    {
        $this->description = $desc;

        return $this;
    }

    /**
     * Landmark kind
     * @var Kind
     * @ODM\ReferenceOne(targetDocument="Kind")
     */
    protected $kind;

    /**
     * Get landmark kind
     * @return Landmarx\LandmarkBundle\Document\Kind Landmark kind
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * Get landmark kind
     * @return Landmarx\LandmarkBundle\Document\Kind Landmark kind
     */
    public function getType()
    {
        return $this->kind;
    }

    /**
     * Set landmark kind
     * @param Landmarx\LandmarkBundle\Document\Kind $kind Landmark kind
     */
    public function setKind($kind)
    {
        $this->kind = $kind;

        return $this;
    }

    /**
     * Set landmark kind
     * @param Landmarx\LandmarkBundle\Document\Kind $kind Landmark kind
     */
    public function setType($kind)
    {
        $this->kind = $kind;

        return $this;
    }

    /**
     * Landmark Categories
     * @var array
     * @ODM\ReferenceMany(targetDocument="Category")
     */
    protected $categories = array();

    /**
     * Get landmark categories
     * @return array Landmark categories
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Get landmark category
     * @param  string Landmark category name
     * @return Landmarx\LandmarkBundle\Document\Category $category Landmark category
     */
    public function getCategory($category)
    {
        if (is_object($this->categories[$category])) {
            return $this->categories[$category];
        }

        return false;
    }

    /**
     * Set landmark categories
     * @param Array $categories [description]
     */
    public function setCategories(Array $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Add a landmark category
     * @param Landmarx\LandmarkBundle\Document\Category $category Landmark category
     */
    public function addCategory($category)
    {
        if (is_object($category)) {
            $this->categories[] = $category;

            return $this;
        }

        return false;
    }

    /**
     * Landmark Attributes
     * @var array
     * @ODM\ReferenceMany(targetDocument="Attribute")
     */
    protected $attributes = array();

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getAttribute($attribute)
    {
        if (is_object($this->attributes[$attribute])) {
            return $this->attributes[$attribute];
        }

        return false;
    }

    /**
     * Set attributes
     * @param  Array  $attributes Landmark attribute
     * @return Landmarx\LandmarkBundle\Document\Landmark Landmark
     */
    public function setAttributes(Array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function setattribute($attribute)
    {
        if (is_object($attribute)) {
            $this->attributes[] = $attribute;

            return $this;
        }

        return false;
    }

    /**
     * Landmark
     * @var Landmarx\LandmarkBundle\Document\Landmark
     * @ODM\ReferenceOne(targetDocument="Landmark")
     */
    protected $parent = null;

    /**
     * Get parent landmark
     * @return Landmarx\LandmarkBundle\Document\Landmark Parent landmark
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set parent landmark
     * @param Landmarx\LandmarkBundle\Document\Landmark $parent Parent landmark
     */
    public function setParent(Landmarx\LandmarkBundle\Document\Landmark $parent)
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
