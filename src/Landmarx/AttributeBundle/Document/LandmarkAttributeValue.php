<?php
namespace Landmarx\AttributeBundle\Document;

use Landmarx\AttributeBundle\Document\LandmarkAttribute;
use Landmarx\AttributeBundle\Document\Value;

class LandmarkAttributeValue
{
	/**
     * Attribute id
     * @var integer
     * @ODM\Id
     */
    protected $id;

    /**
     * LandmarkAttribute
     * @var Landmarx\AttributeBundle\Document\LandmarkAttribute
     * @ODM\ReferenceOne(targetDocument="LandmarkAttribute")
     */
    protected $landmarkAttribute;

    /**
     * Value
     * @var Landmarx\AttributeBundle\Document\Value
     * @ODM\ReferenceOne(targetDocument="Value")
     */
	protected $value;

	/**
     * Get LandmarkAttributeValue id
     * @return integer Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get landmarkAttribute
     * @return LandmarkAttribute landmarkAttribute
     */
	public function getLandmarkAttribute()
	{
		return $this->landmarkAttribute;
	}

	/**
	 * Get value
	 * @return [type] [description]
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Set landmarkAttribute
	 * @param LandmarkAttribute $landmarkAttribute landmarkAttribute
	 */
	public function setLandmarkAttribute(LandmarkAttribute $landmarkAttribute)
	{
		$this->landmarkAttribute = $landmarkAttribute;

		return $this;
	}

	/**
	 * Set value
	 * @param Value $value value
	 */
	public function setValue(Value $value)
	{
		$this->value = $value;

		return $this;
	}
}