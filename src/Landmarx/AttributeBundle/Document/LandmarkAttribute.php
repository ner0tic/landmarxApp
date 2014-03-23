<?php
namespace Landmarx\AttributeBundle\Document;

use Landmarx\LandmarkBundle\Document\Landmark;
use Landmarx\AttributeBundle\Document\Attribute;

class LandmarkAttribute
{
	/**
     * LandmarkAttribute id
     * @var integer
     * @ODM\Id
     */
    protected $id;

	/**
     * Landmark
     * @var Landmarx\LandmarkBundle\Document\Landmark
     * @ODM\ReferenceOne(targetDocument="Landmark")
     */
	protected $landmark;

	/**
     * Attribute
     * @var Landmarx\AttributeBundle\Document\Attribute
     * @ODM\ReferenceOne(targetDocument="Attribute")
     */
	protected $attribute;

	/**
     * Get LandmarkAttribute id
     * @return integer Id
     */
    public function getId()
    {
        return $this->id;
    }

	/**
	 * Get landmark
	 * @return Landmark landmark
	 */
	public function getLandmark()
	{
		return $this->landmark;
	}

	/**
	 * Get attribute
	 * @return Attribute attribute
	 */
	public function getAttribute()
	{
		return $this->attribute;
	}

	/**
	 * Set landmark
	 * @param Landmark $landmark landmark
	 */
	public function setLandmark(Landmark $landmark)
	{
		$this->landmark = $landmark;

		return $this;
	}

	/**
	 * Set attribute
	 * @param Attribute $attribute attribute
	 */
	public function setAttribute(Attribute $attribute)
	{
		$this->attribute = $attribute;

		return $this;
	}
}