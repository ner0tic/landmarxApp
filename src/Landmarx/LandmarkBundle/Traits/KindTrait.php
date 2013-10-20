<?php
namespace Landmarx\LandmarkBundle\Traits;

use Landmarx\LandmarkBundle\Document\Kind;

trait KindTrait
{
    /**
     * Kind id
     * @var integer
     * @ODM\Id
     */
    protected $id;

    /**
     * Get kind id
     * @return integer Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set kind id
     * @param integer $id Id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @inheritdoc
     * @ODM\String
     */
    protected $name = null;

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritdoc
     * @ODM\String
     */
    protected $description = null;

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @inheritdoc
     */
    public function setDescription($desc)
    {
        $this->description = $desc;

        return $this;
    }

    /**
     * Kind parent
     * @var Kind $parent
     * @ODM\ReferenceOne(targetDocument="Kind")
     */
    protected $parent = null;

    /**
     * Get kind parent
     * @return Kind kind parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set kind parent
     * @param Kind $parent kind parent
     */
    public function setParent(Kind $parent)
    {
        $this->parent = $parent;

        return $this;
    }
}
