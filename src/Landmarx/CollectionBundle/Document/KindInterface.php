<?php
namespace Landmarx\CollectionBundle\Document;

use Landmarx\UserBundle\Document\TimestampableInterface;

interface KindInterface extends TimestampableInterface
{
    /**
     * Get kind name
     * @return string attribute name
     */
    public function getName();

    /**
     * Set kind name
     * @param string $name attribute name
     */
    public function setName($name);

    /**
     * Get kind description
     * @return string description
     */
    public function getDescription();

    /**
     * Set kind description
     * @param string $description description
     */
    public function setDescription($description);
}
