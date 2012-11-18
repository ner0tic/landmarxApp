<?php

namespace Landmarx\Landmark;

/**
 * Interface implemented by a landmark item.
 *
 * It roughly represents a single <li> tag and is what you should interact with
 * most of the time by default.
 * Originally taken from ioMenuPlugin (http://github.com/weaverryan/ioMenuPlugin)
 */
interface ItemInterface extends  \ArrayAccess, \Countable, \IteratorAggregate {
    /**
     * @param FactoryInterface $factory
     *
     * @return ItemInterface
     */
    public function setFactory(FactoryInterface $factory);

    /**
     * @return string
     */
    public function getName();

    /**
     * Renames the item.
     *
     * This method must also update the key in the parent.
     *
     * Provides a fluent interface
     *
     * @param string $name
     *
     * @return ItemInterface
     *
     * @throws \InvalidArgumentException if the name is already used by a sibling
     */
    public function setName($name);

    /**
     * Get the description for a landmark item
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set the description for a landmark item
     *
     * Provides a fluent interface
     *
     * @param string $description The description to set on this landmark item
     *
     * @return ItemInterface
     */
    public function setDescription($desc);
    
    /**
     * set lattiude for landmark
     * 
     * return $latitude
     */
    public function getLatitude();
    
    /**
     * Sets the latitude for the landmark item
     * 
     * @param $lat
     */
    public function setLatitude($lat);
    
    /**
     * set lattiude for landmark
     * 
     * return $longiude
     */
    public function getLongtitude();
    
    /**
     * Sets the longitude for the landmark item
     * 
     * @param $lng
     */
    public function setLongitude($lng);
    
    /**
     * Returns the lat/lng eithe r as an array or as a 
     * string with a given delimiter
     * 
     * @param boolean $asString
     * @param string $delimiter
     */
    public function getLatLng($asString, $delimiter);
    
    /**
     * Sets the lat/lng either via an array or as 
     * seperate variables
     * 
     * @param $lat
     * @param $lng
     */
    public function setLatLng($lat, $lng);

    /**
     * Add a child landmark item to this landmark
     *
     * Returns the child item
     *
     * @param ItemInterface|string $child   An ItemInterface instance or the name of a new item to create
     * @param array                $options If creating a new item, the options passed to the factory for the item
     *
     * @return ItemInterface
     * @throws \InvalidArgumentException if the item is already in a tree
     */
    public function addChild($child, array $options = array());

    /**
     * Returns the child landmark identified by the given name
     *
     * @param string $name Then name of the child landmark to return
     *
     * @return ItemInterface|null
     */
    public function getChild($name);

    /**
     * Moves child to specified position. Rearange other children accordingly.
     *
     * Provides a fluent interface
     *
     * @param integer $position Position to move child to.
     *
     * @return ItemInterface
     */
    public function moveToPosition($position);

    /**
     * Moves child to specified position. Rearange other children accordingly.
     *
     * Provides a fluent interface
     *
     * @param ItemInterface $child    Child to move.
     * @param integer       $position Position to move child to.
     *
     * @return ItemInterface
     */
    public function moveChildToPosition(ItemInterface $child, $position);

    /**
     * Moves child to first position. Rearange other children accordingly.
     *
     * Provides a fluent interface
     *
     * @return ItemInterface
     */
    public function moveToFirstPosition();

    /**
     * Moves child to last position. Rearange other children accordingly.
     *
     * Provides a fluent interface
     *
     * @return ItemInterface
     */
    public function moveToLastPosition();

    /**
     * Reorder children.
     *
     * Provides a fluent interface
     *
     * @param array $order New order of children.
     *
     * @return ItemInterface
     */
    public function reorderChildren($order);

    /**
     * Makes a deep copy of landmark tree. Every item is copied as another object.
     *
     * @return ItemInterface
     */
    public function copy();

    /**
     * Get slice of landmark as another landmark.
     *
     * If offset and/or length are numeric, it works like in array_slice function:
     *
     *   If offset is non-negative, slice will start at the offset.
     *   If offset is negative, slice will start that far from the end.
     *
     *   If length is null, slice will have all elements.
     *   If length is positive, slice will have that many elements.
     *   If length is negative, slice will stop that far from the end.
     *
     * It's possible to mix names/object/numeric, for example:
     *   slice("child1", 2);
     *   slice(3, $child5);
     * Note: when using a child as limit, it will not be included in the returned landmark.
     * the slice is done before this landmark.
     *
     * @param mixed $offset Name of child, child object, or numeric offset.
     * @param mixed $length Name of child, child object, or numeric length.
     *
     * @return ItemInterface
     */
    public function slice($offset, $length = 0);

    /**
     * Split landmark into two distinct landmarks.
     *
     * @param mixed $length Name of child, child object, or numeric length.
     *
     * @return array Array with two landmarks, with "primary" and "secondary" key
     */
    public function split($length);

    /**
     * Returns the level of this landmark item
     *
     * The root landmark item is 0, followed by 1, 2, etc
     *
     * @return integer
     */
    public function getLevel();

    /**
     * Returns the root ItemInterface of this landmark tree
     *
     * @return ItemInterface
     */
    public function getRoot();

    /**
     * Returns whether or not this landmark item is the root landmark item
     *
     * @return boolean
     */
    public function isRoot();

    /**
     * @return ItemInterface|null
     */
    public function getParent();

    /**
     * Used internally when adding and removing children
     *
     * Provides a fluent interface
     *
     * @param ItemInterface|null $parent
     *
     * @return ItemInterface
     */
    public function setParent(ItemInterface $parent = null);

    /**
     * Return the children as an array of ItemInterface objects
     *
     * @return array
     */
    public function getChildren();

    /**
     * Provides a fluent interface
     *
     * @param array $children An array of ItemInterface objects
     *
     * @return ItemInterface
     */
    public function setChildren(array $children);

    /**
     * Removes a child from this landmark item
     *
     * Provides a fluent interface
     *
     * @param ItemInterface|string $name The name of ItemInterface instance or the ItemInterface to remove
     *
     * @return ItemInterface
     */
    public function removeChild($name);

    /**
     * @return ItemInterface
     */
    public function getFirstChild();

    /**
     * @return ItemInterface
     */
    public function getLastChild();

    /**
     * Returns whether or not this landmark items has viewable children
     *
     * This landmark MAY have children, but this will return false if the current
     * user does not have access to view any of those items
     *
     * @return boolean
     */
    public function hasChildren();

    /**
     * Whether this landmark item is last in its parent
     *
     * @return boolean
     */
    public function isLast();

    /**
     * Whether this landmark item is first in its parent
     *
     * @return boolean
     */
    public function isFirst();

    /**
     * Calls a method recursively on all of the children of this item
     *
     * @example
     * $landmark->callRecursively('setShowChildren', array(false));
     *
     * Provides a fluent interface
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return ItemInterface
     */
    public function callRecursively($method, $arguments = array());

    /**
     * Exports this landmark item to an array
     *
     * The children are exported until the specified depth:
     *      null: no limit
     *      0: no children
     *      1: only direct children
     *      ...
     *
     * @param integer $depth
     *
     * @return array
     */
    public function toArray($depth = null);
}