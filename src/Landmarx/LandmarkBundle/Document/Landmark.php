<?php
namespace Landmarx\LandmarkBundle\Document;

use Landmarx\Landmark\LandmarkItem;
use Landmarx\LandmarkBundle\Document\LandmarkCategory;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Oh\GoogleMapFormTypeBundle\Validator\Constraints as OhAssert;

/**
 * @MongoDB\Document
 */
class Landmark extends LandmarkItem 
{
  /**
   * @MongoDB\Id 
   */
  protected $id;
  
  /**
   * @var type 
   */
  protected $categories = array();
  
  /**
   * @var type 
   */
  protected $primary_category = null;
  
  public function getCategories()
  {
    return $this->categories;
  }
  
  public function setCategories($categories = array())
  {
    $this->categories = $categories;
    
    if ( !in_array( $this->primary_category, $this->categories ) )
    {
      $this->primary_category = null;
    }
    
    return $this;
  }
  
    public function addCategory( $category, $attributes = array() ) 
    {
        if ( !$category instanceof LandmarkCategory )
        {
          $category = new LandmarkCategory($category, $attributes);
        }
        $this->categories[ $category->getName() ] = $category;

        return $category;
    }

    public function getCategory($name)
    {
        return isset ( $this->categories[ $name ] ) ? $this->categories[ $name ] : null;
    }

    public function setLatLng($latlng)
    {
        $this->setLat( $latlng[ 'lat' ] );
        $this->setLng( $latlng[ 'lng' ] );
        return $this;
    }

    /**
     * @Assert\NotBlank()
     * @OhAssert\LatLng()
     */
    public function getLatLng()
    {
        return array( 'lat' => $this->getLat(), 'lng' => $this->getLng() );
    }
}