<?php
namespace Landmarx\UserBundle\Document;

interface TimestampableInterface
{
    /**
     * Get datetime item was created
     * @return DateTime timestamp
     */
    public function getCreated();

    /**
     * Set datetime item is created
     * @param DateTime $timestamp timestamp
     */
    public function setCreated(\DateTime $timestamp);

    /**
     * Get datetime item was updated
     * @return DateTime timestamp
     */
    public function getUpdated();

    /**
     * Set datetime item is updated
     * @param DateTime $timestamp timestamp
     */
    public function setUpdated(\DateTime $timestamp);
}
