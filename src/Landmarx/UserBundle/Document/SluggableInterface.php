<?php
namespace Landmarx\UserBundle\Document;

use Landmarx\UserBundle\Document\User;

interface SluggableInterface
{
    /**
     * Get slug
     * @return string slug
     */
    public function getSlug();

    /**
     * Set slug
     * @param string $slug slug
     */
    public function setCreatedBy(User $user);
}
