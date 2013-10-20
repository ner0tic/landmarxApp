<?php
namespace Landmarx\UserBundle\Traits;

trait TimestampableTrait
{
    /**
      * @var datetime $created
      *
      * @Gedmo\Timestampable(on="create")
      * @ODM\Timestamp
      */
    protected $created;

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    protected $updated;

    public function getUpdated()
    {
        return $this->updated;
    }

    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }
}
