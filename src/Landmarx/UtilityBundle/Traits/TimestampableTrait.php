<?php
namespace Landmarx\UtilityBundle\Traits;

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

    public function setCreated(\DateTime $timestamp)
    {
        $this->created = $timestamp;
        return $this;
    }

    protected $updated;

    public function getUpdated()
    {
        return $this->updated;
    }

    public function setUpdated(\DateTime $timestamp)
    {
        $this->updated = $timestamp;
        return $this;
    }
}
