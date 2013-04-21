<?php
namespace Landmarx\LandmarkCollection\Entity;

use Doctrine\ORM\Mapping as ORM,
    Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\Common\Collections\ArrayCollection,
    Symfony\Component\Validator\Constratints as Assert;

/**

  @ORM\Entity(repositoryClass="Landmarx\CollectionBundle\Repository\LandmarkCollectionRepository")
 * @ORM\Table(name="landmark_collection")
 */
class LandmarkCollection 
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
     * @ORM\ManyToOne(targetEntity="Landmarx\CollectionBundle\Entity\LandmarkCollectionKind", inversedBy="landmark_collection")
     * @ORM\JoinColumn(name="kind_id", referencedColumnName="id")
     */  
    protected $kind;
    
    /**
      * @ORM\OneToMany(targetEntity="Landmarx\LandmarkBundle\Entity\Landmark", mappedBy="landmark_collection")
      */
    protected $landmarks;
    
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
}