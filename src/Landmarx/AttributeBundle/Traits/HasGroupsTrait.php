<?php
namespace Landmarx\AttributeBundle\Traits;

trait HasGroupsTrait
{
    /**
     * Attribute Group
     * @var array
     * @ODM\ReferenceMany(targetDocument="Group")
     */
    protected $groups;

    /**
     * Get Attribute groups
     * @return array Attribute groups
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Get Attribute group
     * @param  string Attribute group name
     * @return Landmarx\AttributeBundle\Document\Group $group Attribute group
     */
    public function getGroup($group)
    {
        return $this->groups->get($group);
    }

    /**
     * Set Attribute groups
     * @param Array $groups [description]
     */
    public function setGroups(array $groups)
    {
        if (! $groups instanceof ArrayCollection) {
            $groups = new ArrayCollection($groups);
        }

        $this->groups = $groups;

        return $this;
    }

    /**
     * Add a Attribute group
     * @param Landmarx\AttributeBundle\Document\Group $group Attribute group
     */
    public function addgroup(group $group)
    {
        return $this->groups->add($group);
    }

    public function hasgroup($group)
    {
        return !$this->groups->isEmpty();
    }

    public function removegroup(group $group)
    {
        return $this->groups->remove($group);
    }
}