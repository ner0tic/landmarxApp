<?php
namespace Landmarx\LandmarkBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\Common\Collections\ArrayCollection,
    Symfony\Component\Validator\Constraints as Assert;

/**

  @ORM\Entity(repositoryClass="Landmarx\LandmarkBundle\Repository\LandmarkCategoryRepository")
 * @ORM\Table(name="landmark_category")
 */
class LandmarkCategory
{
    /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */    
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $description;
    
    /**
   * @ORM\ManyToOne(targetEntity="LandmarkCategory", inversedBy="landmark_category")
   * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
   */ 
    protected $parent;
    
    /**
     * @ORM\Column(type="boolean")     
     */
    protected $public;
    
    /**
   * @var datetime $created
   *
   * @Gedmo\Timestampable(on="create")
   * @ORM\Column(type="datetime")
   */
    protected $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    /**
     * @Gedmo\Slug(fields={"name"}) 
     * @ORM\Column(length=128, unique=true)
     */
    protected $slug;  

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
     * Set name
     *
     * @param string $name
     * @return LandmarkCategory
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param text $description
     * @return LandmarkCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set public
     *
     * @param boolean $public
     * @return LandmarkCategory
     */
    public function setPublic($public)
    {
        $this->public = $public;
        return $this;
    }

    /**
     * Get public
     *
     * @return boolean 
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set created
     *
     * @param datetime $created
     * @return LandmarkCategory
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param datetime $updated
     * @return LandmarkCategory
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * Get updated
     *
     * @return datetime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return LandmarkCategory
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set parent
     *
     * @param Landmarx\LandmarkBundle\Entity\LandmarkCategory $parent
     * @return LandmarkCategory
     */
    public function setParent(\Landmarx\LandmarkBundle\Entity\LandmarkCategory $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return Landmarx\LandmarkBundle\Entity\LandmarkCategory 
     */
    public function getParent()
    {
        return $this->parent;
    }
}