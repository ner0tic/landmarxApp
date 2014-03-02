<?php
namespace Landmarx\AttributeBundle\Traits;

trait ToggleVisibilityTrait
{
        /**
     * Attribute visibility
     * @var Type
     * @ODM\Boolean
     */
    protected $public = true;

    /**
     * Set public
     *
     * @param boolean $public
     * @return group
     */
    public function setPublic(bool $public)
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
}
