<?php
namespace Landmarx\LandmarkBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\Common\Collections\ArrayCollection,
    Symfony\Component\Validator\Constraints as Assert;

/**

  @ORM\Entity(repositoryClass="Landmarx\LandmarkBundle\Repository\LandmarkRepository")
 * @ORM\Table(name="landmark")
 */
class Landmark 
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
     * @ORM\Column(type="string", length=150)
     */
    protected $latitude;
    
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $longitude;
    
    /**
     * @ORM\ManyToOne(targetEntity="Landmarx\LandmarkBundle\Entity\LandmarkKind", inversedBy="landmark")
     * @ORM\JoinColumn(name="kind_id", referencedColumnName="id")
     */  
    protected $kind;
    
    /**
      * @ORM\OneToMany(targetEntity="Landmarx\LandmarkBundle\Entity\LandmarkCategory", mappedBy="landmark")
      */
    protected $categories;    
    
    /**
     * @ORM\Column(type="boolean")     
     */
    protected $public;
    
    /**
     * @ORM\ManyToOne(targetEntity="Landmarx\UserBundle\Entity\User", inversedBy="landmark")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
      * @Gedmo\Slug(fields={"name"}) 
      * @ORM\Column(unique=true)
      * @Assert\MaxLength(128)
      */
    protected $slug;
    
    
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
    
    public function __construct() 
    {
        $this->categories = new ArrayCollection();
    }

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
     * @return Landmark
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
     * @return Landmark
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
     * Set latitude
     *
     * @param string $latitude
     * @return Landmark
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param decimal $longitude
     * @return Landmark
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * Get longitude
     *
     * @return decimal 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set public
     *
     * @param boolean $public
     * @return Landmark
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
     * Set slug
     *
     * @param string $slug
     * @return Landmark
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
     * Set created
     *
     * @param datetime $created
     * @return Landmark
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
     * @return Landmark
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
     * Set kind
     *
     * @param Landmarx\LandmarkBundle\Entity\LandmarkKind $kind
     * @return Landmark
     */
    public function setKind(\Landmarx\LandmarkBundle\Entity\LandmarkKind $kind = null)
    {
        $this->kind = $kind;
        return $this;
    }

    /**
     * Get kind
     *
     * @return Landmarx\LandmarkBundle\Entity\LandmarkKind 
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * Add categories
     *
     * @param Landmarx\LandmarkBundle\Entity\LandmarkCategory $categories
     * @return Landmark
     */
    public function addCategorie(\Landmarx\LandmarkBundle\Entity\LandmarkCategory $categories)
    {
        $this->categories[] = $categories;
        return $this;
    }

    /**
     * Remove categories
     *
     * @param Landmarx\LandmarkBundle\Entity\LandmarkCategory $categories
     */
    public function removeCategorie(\Landmarx\LandmarkBundle\Entity\LandmarkCategory $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set user
     *
     * @param Landmarx\UserBundle\Entity\User $user
     * @return Landmark
     */
    public function setUser(\Landmarx\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return Landmarx\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}