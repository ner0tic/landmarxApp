<?php
namespace Landmarx\LandmarkBundle\Document;

use Landmarx\UserBundle\Document\TimestampableInterface;

interface UserInterface extends TimestampableInterface
{
    /**
     * Get firstname
     * @return string firstname
     */
    public function getFirstname();

    /**
     * Set firstname
     * @param string $firstname firstname
     */
    public function setFirstname($firstname);

    /**
     * Get lastname
     * @return string lastname
     */
    public function getLastname();

    /**
     * Set lastname
     * @param string $lastname lastname
     */
    public function setLastname($lastname);

    /**
     * Get name
     * @return string name
     */
    public function getName();
}
