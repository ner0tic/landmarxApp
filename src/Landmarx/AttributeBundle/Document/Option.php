<?php
namespace Landmarx\AttributeBundle\Document;

use Landmarx\AttributeBundle\Document\Value;

class Option
{
    /**
     * Option id
     * @var integer
     * @ODM\Id
     */
    protected $id;

    /**
     * Option name
     * @var string
     * @ODM\String
     */
    protected $name = null;

    /**
     * Option label
     * @var String
     * @ODM\String
     */
    protected $label;

    /**
     * Value
     * @var Value
     * @ODM\ReferenceOne(targetDocument="Value")
     */
    protected $value;

    /**
     * Get name
     * @return String name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get label display label
     * @return String label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Get value 
     * @return Value value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set name
     * @param String $name name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set label
     * @param String $label label
     */
    public function setLabel($label)
    {
        $this->label = $label;

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
