<?php
namespace Landmarx\LandmarkBundle\Document;

use Landmarx\UserBundle\Document\TimestampableInterface;

interface CategoryInterface extends TimestampableInterface
{
    /**
     * Get category name
     * @return string attribute name
     */
    public function getName();

    /**
     * Set category name
     * @param string $name attribute name
     */
    public function setName($name);

    /**
     * Get category description
     * @return string description
     */
    public function getDescription();

    /**
     * Set category description
     * @param string $description description
     */
    public function setDescription($description);
}
