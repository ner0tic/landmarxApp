<?php
namespace Landmarx\AttributeBundle\Document;

class Option
{
    protected $name;

    protected $label;

    protected $value;

    public function getName()
    {
        return $this->name;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getValue()
    {
        return $this->value;
    }
}
