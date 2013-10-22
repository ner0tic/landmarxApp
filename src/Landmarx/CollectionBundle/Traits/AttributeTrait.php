<?php
namespace Landmarx\CollectionBundle\Traits;

use Landmarx\UserBundle\Document\AttributeTypes;
use Landmarx\CollectionBundle\Document\Attribute;

trait AttributeTrait
{
    /**
     * Attribute id
     * @var integer
     * @ODM\Id
     */
    protected $id;

    /**
     * Get attribute id
     * @return integer Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set attribute id
     * @param integer $id Id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Attribute name
     * @var string
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
     * Attribute parent
     * @var Landmarx\CollectionBundle\Document\Attribute attribute
     */
    protected $parent;

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @ODM\Boolean
     */
    protected $public = true;

    /**
     * Set public
     *
     * @param boolean $public
     * @return Attribute
     */
    public function setPublic($public = true)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Is public
     *
     * @return boolean
     */
    public function isPublic()
    {
        return (bool) $this->public;
    }

    /**
     * Attribute display name
     * @var string
     * @ODM\String
     */
    protected $display = null;

    /**
     * Get attribute display name
     * @return string attribute display name
     */
    public function getDisplay()
    {
        return (null == $this->display) ? $this->name : $this->display;
    }

    /**
     * Set attribute display name
     * @param string $display attribute display name
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    /**
     * Attribute type
     * @var string
     * @ODM\String
     */
    protected $type = 'Text';

    /**
     * Get attribute type
     * @return string attribute type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set attribute type
     * @param string $type attribute type
     */
    public function setType($type)
    {
        $types = new AttributeTypes();
        if (in_array($type, $types->getChoices())) {
            $this->type = $type;
        } else {
            // inform user of bad type.
        }

        return $this;
    }

    /**
     * Attribute configuration
     * @var string
     */
    protected $configuration = null;

    /**
     * Get attribute configuration
     * @return string attribute configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Set attribute configuration
     * @param string $config description
     */
    public function setConfiguration($config)
    {
        $this->configuration = $config;

        return $this;
    }
}
