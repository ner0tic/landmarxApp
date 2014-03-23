<?php
namespace Landmarx\AttributeBundle\Traits;

use Landmarx\AttributeBundle\Document\Attribute;

trait HasAttributesTrait
{
    /**
     * Attribute
     * @var array
     * @ODM\ReferenceMany(targetDocument="Attribute")
     */
    protected $attributes;

    /**
     * Get Attributes
     * @return array Attributes
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Get Attribute
     * @param  string Attribute name
     * @return Landmarx\AttributeBundle\Document\Attribute $attribute attribute
     */
    public function getAttribute($attribute)
    {
        return $this->attributes->get($attribute);
    }

    /**
     * Set Attributes
     * @param Array $attributes [description]
     */
    public function setAttributes(array $attributes)
    {
        if (! $attributes instanceof ArrayCollection) {
            $attributes = new ArrayCollection($attributes);
        }

        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Add a Attribute
     * @param Landmarx\AttributeBundle\Document\Attribute $attribute attribute
     */
    public function addAttribute(attribute $attribute)
    {
        return $this->attributes->add($attribute);
    }

    public function hasAttribute($attribute)
    {
        return !$this->attributes->isEmpty();
    }

    public function removeAttribute(attribute $attribute)
    {
        return $this->attributes->remove($attribute);
    }
}
