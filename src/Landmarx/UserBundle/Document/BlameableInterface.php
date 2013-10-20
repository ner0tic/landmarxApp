<?php
namespace Landmarx\UserBundle\Document;

use Landmarx\UserBundle\Document\User;

interface BlameableInterface
{
    /**
     * Get creator
     * @return User $user user
     */
    public function getCreatedBy();

    /**
     * Set creator
     * @param User $user user
     */
    public function setCreatedBy(User $user);

    /**
     * Get update author
     * @return string user
     */
    public function getUpdatedBy();

    /**
     * Set update author
     * @param User $user [description]
     */
    public function setUpdatedBy(User $user);
}
