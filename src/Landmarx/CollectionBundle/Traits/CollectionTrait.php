<?php
namespace Landmarx\CollectionBundle\Traits;

trait CollectionTrait
{
    /**
     * id
     * @var integer
     * @ODM\Id
     */
    protected $id;

    /**
     * Get id
     * @return integer Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     * @param integer $id Id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Name
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
     * Description
     * @var string
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
     * Kind
     * @var Kind
     * @ODM\ReferenceOne(targetDocument="Kind")
     */
    protected $kind;

    /**
     * @inheritdoc
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * Get kind
     * @return Landmarx\CollectionBundle\Document\Kind Kind
     */
    public function getType()
    {
        return $this->kind;
    }

    /**
     * @inheritdoc
     */
    public function setKind($kind)
    {
        $this->kind = $kind;

        return $this;
    }

    /**
     * Set kind
     * @param Landmarx\CollectionBundle\Document\Kind $kind Kind
     */
    public function setType($kind)
    {
        $this->kind = $kind;

        return $this;
    }

    /**
     * Attributes
     * @var array
     * @ODM\ReferenceMany(targetDocument="Attribute")
     */
    protected $attributes = array();

    /**
     * @inheritdoc
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @inheritdoc
     */
    public function getAttribute($attribute)
    {
        if (is_object($this->attributes[$attribute])) {
            return $this->attributes[$attribute];
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function setAttributes(Array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setattribute($attribute)
    {
        if (is_object($attribute)) {
            $this->attributes[] = $attribute;

            return $this;
        }

        return false;
    }
}
