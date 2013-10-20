<?php
namespace Landmarx\LandmarkBundle\Document;

use Landmarx\UserBundle\Document\TimestampableInterface;

interface LandmarkInterface extends TimestampableInterface
{
    /**
     * Get landmark name
     * @return string attribute name
     */
    public function getName();

    /**
     * Set landmark name
     * @param string $name attribute name
     */
    public function setName($name);

    /**
     * Get landmark description
     * @return string description
     */
    public function getDescription();

    /**
     * Set landmark description
     * @param string $description description
     */
    public function setDescription($description);

    /**
     * Get landmark kind
     * @return Kind landmark kind
     */
    public function getKind();

    /**
     * Set landmark kind
     * @param Kind $kind landmark kind
     */
    public function setKind(Kind $kind);

    /**
     * Get landmark categories
     * @return array landmark categories
     */
    public function getCategories();

    /**
     * Set landmark categories
     * @param array $categories landmark categories
     */
    public function setCategories(array $categories);

    /**
     * Is landmark within category
     * @param  string $category category
     * @return boolean
     */
    public function hasCategory($category);

    /**
     * Get landmark category
     * @param  string $category category name
     * @return Category cateory
     */
    public function getCategory($category);

    /**
     * Add landmark category
     * @param Category $category landmark category
     */
    public function addCategory(Category $category);

    /**
     * Remove landmark category
     * @param  Category $category landmark category
     */
    public function removeCategory(Category $category);

    /**
     * Get landmark attributes
     * @return array landmark attributes
     */
    public function getAttributes();

    /**
     * Set landmark attributes
     * @param array $attributes landmark attributes
     */
    public function setAttributes(array $attributes);

    /**
     * Is landmark within attribute
     * @param  string $attribute attribute
     * @return boolean
     */
    public function hasAttribute($attribute);

    /**
     * Get landmark attribute
     * @param  string $attribute attribute name
     * @return Attribute cateory
     */
    public function getAttribute($attribute);

    /**
     * Add landmark attribute
     * @param Attribute $attribute landmark attribute
     */
    public function addAttribute(Attribute $attribute);

    /**
     * Remove landmark attribute
     * @param  Attribute $attribute landmark attribute
     */
    public function removeAttribute(Attribute $attribute);
}
