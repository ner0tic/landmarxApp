<?php
namespace Landmarx\LandmarkCollectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Gedmo\Mapping\Annotation as Gedmo,
    Doctrine\Common\Collections\ArrayCollection,
    Symfony\Component\Validator\Constraints as Assert;

/**

  @ORM\Entity(repositoryClass="Landmarx\LandmarkCollectionBundle\Repository\LandmarkCollectionKindRepository")
 * @ORM\Table(name="landmark")
 */
class LandmarkCollectionKind
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
   * @ORM\ManyToOne(targetEntity="LandmarkCollectionKind", inversedBy="landmark_kind")
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

}