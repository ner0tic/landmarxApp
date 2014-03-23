<?php
namespace Landmarx\AttributeBundle\Document;

class Value
{
	/**
     * Value id
     * @var integer
     * @ODM\Id
     */
    protected $id;

    /**
     * Value
     * @var String
     */
    protected $value;

    /**
     * Get Value id
     * @return integer Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get value
     * @return String value
     */
    public function getValue()
    {
    	return $this->value;
    }

    /**
     * Set value
     * @param String $value value
     */
    public function setValue($value)
    {
    	$this->value = $value;

    	return $this;
    }
}