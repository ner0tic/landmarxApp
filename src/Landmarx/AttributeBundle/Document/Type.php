<?php
namespace Landmarx\AttributeBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

use Landmarx\UtilityBundle\Traits\BlameableTrait;
use Landmarx\UtilityBundle\Traits\SluggableTrait;
use Landmarx\UtilityBundle\Traits\TimestampableTrait;
use Landmarx\AttributeBundle\Traits\ToggleVisibilityTrait;
use Landmarx\AttributeBundle\Traits\HasGroupsTrait;
use Landmarx\AttributeBundle\Renderer\AttributeRenderer;
use Landmarx\AttributeBundle\Interfaces\RendererInterface;

/**
 * @ODM\Document(repositoryClass="Landmarx\AttributeBundle\Repository\TypeRepository")
 */
class Type
{
    use SluggableTrait;
    use TimestampableTrait;
    use BlameableTrait;
    use ToggleVisibilityTrait;
    use HasGroupsTrait;

    /**
     * Type id
     * @var integer
     * @ODM\Id
     */
    protected $id;

    /**
     * Type name
     * @var string
     * @ODM\String
     */
    protected $name = null;

    /**
     * Type description
     * @var string Type description
     * @ODM\String
     */
    protected $description = null;

    /**
     * Type renderer
     * @var string
     * @ODM\String
     */
    protected $renderer = 'Landmarx\AttributeBundle\Renderer\AttributeRenderer';

    /**
     * Type
     * @var Landmarx\AttributeBundle\Document\Type
     * @ODM\ReferenceOne(targetDocument="Type")
     */
    protected $parent = null;

    /**
     * Get Type id
     * @return integer Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Type name
     * @return string Type name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get description
     * @return string Type description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get Type type
     * @return Landmarx\AttributeBundle\Document\Type Type type
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * Get parent Type
     * @return Type Parent Type
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set Type name
     * @param string $name Type name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set Type description
     * @param string $desc Type description
     */
    public function setDescription($desc)
    {
        $this->description = $desc;

        return $this;
    }

    /**
     * Set Type type
     * @param Landmarx\AttributeBundle\Interfaces\RendererInterface $renderer Renderer
     */
    public function setRenderer(RendererInterface $renderer)
    {
        $this->renderer = $renderer;

        return $this;
    }

    /**
     * Set parent Type
     * @param Type $parent Parent Type
     */
    public function setParent(Type $parent)
    {
        $this->parent = $parent;

        return $this;
    }
}
