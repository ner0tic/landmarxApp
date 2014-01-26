<?php
namespace Landmarx\UtilityBundle\Traits;

trait SluggableTrait
{
     /**
      * @Gedmo\Slug(fields={"name"})
      * @ODM\String
      */
    protected $slug;

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
}
