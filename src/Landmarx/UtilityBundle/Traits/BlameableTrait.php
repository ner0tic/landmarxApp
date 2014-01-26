<?php
namespace Landmarx\UtilityBundle\Traits;

use Landmarx\UserBundle\Document\User;

trait BlameableTrait
{
    /**
     * @var Landmarx\UserBundle\Document\User
     * @ODM\ReferenceOne(targetDocument="User")
     */
    protected $created_by;

    /**
     * @inheritdoc
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * @inheritdoc
     */
    public function setCreatedBy(User $user)
    {
        $this->created_by = $user;

        return $user;
    }

    /**
     * Document Update Author
     * @var Landmarx\UserBundle\Document\User
     * @ODM\ReferenceOne(targetDocument="User")
     */
    protected $updated_by;

    /**
     * @inheritdoc
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * @inheritdoc
     */
    public function setUpdatedBy(User $user)
    {
        $this->updated_by = $user;

        return $this;
    }
}
