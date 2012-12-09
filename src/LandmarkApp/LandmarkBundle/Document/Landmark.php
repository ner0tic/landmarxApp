<?php
namespace Landmarx\LandmarkBundle\Document;

use Landmarx\Landmark\LandmarkItem;
use Landmarx\LandmarkBundle\Document\LandmarkCategory;

class Landmark extends LandmarkItem 
{
  protected $categories = array();
  
  protected $primary_category = null;
  
  public function getCategories()
  {
    return $this->categories;
  }
  
  public function setCategories($categories = array())
  {
    $this->categories = $categories;
    
    if(!in_array($this->primary_category, $this->categories))
    {
      $this->primary_category = null;
    }
    
    return $this;
  }
  
  public function addCategory($category, $attributes = array()) {
    if(!$category instanceof LandmarkCategory)
    {
      $category = new LandmarkCategory($category, $attributes);
    }
    $this->categories[$category->getName()] = $category;
    
    return $category;
  }
  
  public function getCategory($name)
  {
    return isset($this->categories[$name]) ? $this->categories[$name] : null;
  }
}