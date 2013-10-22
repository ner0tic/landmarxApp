<?php
namespace Landmarx\CollectionBundle\Document;

use Landmarx\UserBundle\Document\TimestampableInterface;

interface CollectionInterface extends TimestampableInterface
{
    /**
     * Get name
     * @return string name
     */
    public function getName();

    /**
     * Set name
     * @param string $name name
     */
    public function setName($name);

    /**
     * Get description
     * @return string description
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description description
     */
    public function setDescription($description);

    /**
     * Get kind
     * @return Kind description
     */
    public function getKind();

    /**
     * Set kind
     * @param Kind $kind kind
     */
    public function setKind($kind);

    /**
     * Get attributes
     * @return array  attributes
     */
    public function getAttributes();

    /**
     * Set attributes
     * @param array $attributes  attributes
     */
    public function setAttributes(array $attributes);

    /**
     * Is within attribute
     * @param  string $attribute attribute
     * @return boolean
     */
    public function hasAttribute($attribute);

    /**
     * Get attribute
     * @param  string $attribute attribute name
     * @return Attribute cateory
     */
    public function getAttribute($attribute);

    /**
     * Add attribute
     * @param Attribute $attribute  attribute
     */
    public function addAttribute(Attribute $attribute);

    /**
     * Remove attribute
     * @param  Attribute $attribute  attribute
     */
    public function removeAttribute(Attribute $attribute);
}
