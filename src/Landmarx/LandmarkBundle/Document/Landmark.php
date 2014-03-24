<?php
namespace Landmarx\LandmarkBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Oh\GoogleMapFormTypeBundle\Validator\Constraints as OhAssert;
use Gedmo\Mapping\Annotation as Gedmo;

use Landmarx\UtilityBundle\Traits\BlameableTrait;
use Landmarx\UtilityBundle\Traits\GeolocatableTrait;
use Landmarx\UtilityBundle\Traits\SluggableTrait;
use Landmarx\UtilityBundle\Traits\TimestampableTrait;
use Landmarx\UtilityBundle\Traits\ToggleVisibilityTrait;

/**
 * @ODM\Document(repositoryClass="Landmarx\LandmarkBundle\Repository\LandmarkRepository")
 */
class Landmark
{
    use GeolocatableTrait;
    use SluggableTrait;
    use TimestampableTrait;
    use BlameableTrait;
    use ToggleVisibilityTrait;

    /**
     * Landmark id
     * @var integer
     * @ODM\Id
     */
    protected $id;

    /**
     * Landmark name
     * @var string
     * @ODM\String
     */
    protected $name = null;

    /**
     * Landmark description
     * @var string Landmark description
     * @ODM\String
     */
    protected $description = null;

    /**
     * Landmark type
     * @var Type
     * @ODM\ReferenceOne(targetDocument="Type")
     */
    protected $type;

    /**
     * Landmark Categories
     * @var array
     * @ODM\ReferenceMany(targetDocument="Category")
     */
    protected $categories;

    /**
     * Landmark
     * @var Landmarx\LandmarkBundle\Document\Landmark
     * @ODM\ReferenceOne(targetDocument="Landmark")
     */
    protected $parent = null;

    /**
     * Get landmark id
     * @return integer Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get landmark name
     * @return string Landmark name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get description
     * @return string Landmark description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get landmark type
     * @return Landmarx\LandmarkBundle\Document\Type Landmark type
     */
    public function getType()
    {
        return $this->type;
    }

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
        return $this->categories->get($category);
    }

    /**
     * Get parent landmark
     * @return Landmark Parent landmark
     */
    public function getParent()
    {
        return $this->parent;
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
     * Set landmark description
     * @param string $desc Landmark description
     */
    public function setDescription($desc)
    {
        $this->description = $desc;

        return $this;
    }

    /**
     * Set landmark type
     * @param Landmarx\LandmarkBundle\Document\Type $type Landmark type
     */
    public function setType(Type $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set landmark categories
     * @param Array $categories [description]
     */
    public function setCategories(array $categories)
    {
        if (! $categories instanceof ArrayCollection) {
            $categories = new ArrayCollection($categories);
        }

        $this->categories = $categories;

        return $this;
    }

    /**
     * Add a landmark category
     * @param Landmarx\LandmarkBundle\Document\Category $category Landmark category
     */
    public function addCategory(Category $category)
    {
        return $this->categories->add($category);
    }

    /**
     * Set parent landmark
     * @param Landmark $parent Parent landmark
     */
    public function setParent(Landmark $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Set public
     *
     * @param boolean $public
     * @return Category
     */
    public function setPublic($public)
    {
        $this->public = $public;
        return $this;
    }

    /**
     * Is public
     *
     * @return boolean
     */
    public function isPublic($public = null)
    {
        if (null != $public && is_bool($public)) {
            $this->public = $oublic;

            return $this;
        }
        return (bool) $this->public;
    }

    public function hasCategory($category)
    {
        return !$this->categories->isEmpty();
    }

    public function removeCategory(Category $category)
    {
        return $this->categories->remove($category);
    }
}
