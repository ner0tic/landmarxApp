<?php
  namespace Landmarx\Landmark;
  
  use \InvalidArgumentException as InvArg;
  use \ArrayIterator as Itt;

  class LandmarkItem implements ItemInterface {
    /**
     * Name of this landmark item
     * @var string $name 
     */
    protected $name = null;
    
    /**
     * A description about this landmark item
     * @var string $description
     */
    protected $description = null;
        
    /**
     * Decimal representation of latitude coordinates
     * @var float $latitude 
     */
    protected $latitude = null;
    
    /**
     * Decimarl representation of longitude coordinates
     * @var float $longitude
     */
    protected $longtiude = null;
    
    /**
     * Array of landmark attributes
     * @var array $attributes 
     */
    protected $attributes = array();
    
    /**
     * The parent landmark item for this landmark item
     * @var Landmarx\Landmark\LandmarkItem $parent 
     */
    protected $parent = null;
    
    /**
     * Array of landmark items with this landmark item as their parent
     * @var array $children 
     */
    protected $children = array();
    
    /**
     * A landmark item factory
     * @var Landmarx\Landmark\FactoryInterface $factory
     */
    protected $factory;
    
    /**
     * Class constructor
     * 
     * @param string $name The name of this landmark
     * @param \Landmarx\Landmark\FactoryInterface $factory
     */
    public function __construct($name, FactoryInterface $factory) {
      $this->name = $name;
      $this->factory = $factory;
    }
    
    public function setFactory(FactoryInterface $factory) {
      $this->factory = $factory;

      return $this;
    }
    
    public function getName() {
      return $this->name;      
    }
    
    /**
     * Checks if given name is laredy in use within the landmark tree
     * Throws exception is is used.
     * 
     * @param string $name
     * @return string|\Landmarx\Landmark\LandmarkItem
     * @throws InvalidArgumentException
     */
    public function setName($name) {
      if($this->name == $name)  
        return this;
      
      $parent = $this->getParent();
      if(is_null($parent) && isset($parent['name']))
        throw new InvArg('Landmark name is already used.');
      
      $_name = $this->name;
      $this->name = $name;
      
      if(!is_null($parent)) {
        $names = array_keys($parent->getChildren());
        $items = array_values($parent->getChildren());
        
        $offset = array_search($_name, $names);
        $names[$offset] = $name;
        
        $parent->setChildren(array_combine($names, $items));
      }
      return $this;
    }
      
    public function getDescription() {
      return $this->description;
    }
    
    public function setDescription($desc) {
      $this->description = $desc;
      return $this;
    }
    
    public function getLatitude() {
      return $this->latitude;
    }
    
    public function setLatitude($lat) {
      $this->latitude = $lat;
      return $this;
    }
    
    public function getLongitude() {
      return $this->longtiude;
    }
    
    public function setLongitude($lng) {
      $this->longtiude = $lng;
      return $this;
    }
    
    /**
     * Returns either a string representation or an array of coordinates 
     * Allows for custom limiters in the string
     * 
     * @param boolean $asString return coordinates either as a string or an array
     * @param type $delimiter if being returned as a string, this is how 
     *                        they coords are split up.
     * @return string|array
     */
    public function getLatLng($asString = false, $delimiter = ', ') {
      if(!is_null($this->latitude) || !is_null($this->longtiude))
        return false;
      if($asString) return $this->latitude.$delimiter.$this->longtiude;
      else return array($this->latitude,$this->longtiude);
    }
    
    /**
     * Set the coordinates either via an array or as 2 separate variables
     * 
     * @param array|float $lat
     * @param float $lng
     * @return \Landmarx\Landmark\LandmarkItem
     * @throws InvalidArgumentException
     */
    public function setLatLng($lat,$lng = null) {
      if((is_null($lng) && !is_array($lat)) || (is_null($lat)))
        throw new InvArg('must pass an array or two variables.');
      elseif(is_array($lat)) {
        $this->latitude = $lat[0];
        $this->longtiude = $lat[1];
      }
      else {
        $this->latitude = $lat;
        $this->longtiude = $lng;
      }
      return $this;
    }
    
    /**
     * Add a new child to this landmark item
     * Takes in an instance of a landmarkItem or as string name
     * 
     * @param string|Landmarx\Landmark\LandmarkItemInterface $child
     * @param array $options
     * @return Landmarx\Landmark\LandmarkItem
     * @throws InvalidArgumentException
     */
    public function addChild($child, array $options = array()) {
      if(!$child instanceof ItemInterface)  $child = $this->factory->createItem($child, $options);
      elseif(null !== $child->getParent())
        throw new InvArg('Cannot add item as child, it already belongs to another landmark.');
        
      $child->setParent($this);
      $this->children[$child->getName()] = $child;

      return $child;
    }

    public function getChild($name) {
      return isset($this->children[$name]) ? $this->children[$name] : null;
    }

    public function moveToPosition($position) {
      $this->getParent()->moveChildToPosition($this, $position);

      return $this;
    }

    public function moveChildToPosition(ItemInterface $child, $position) {
      $name = $child->getName();
      $order = array_keys($this->children);

      $_position = array_search($name, $order);
      unset($order[$_position]);

      $order = array_values($order);

      array_splice($order, $position, 0, $name);
      $this->reorderChildren($order);

      return $this;
    }

    public function moveToFirstPosition() {
      return $this->moveToPosition(0);
    }

    public function moveToLastPosition() {
      return $this->moveToPosition($this->getParent()->count());
    }

    public function reorderChildren($order) {
      if(count($order) != $this->count())
        throw new InvArg('Cannot reorder children, order does not contain all children.');
        
      $kids = array();

      foreach($order as $name) {
        if(!isset($this->children[$name]))
            throw new InvArg('Cannot find children named ' . $name);

        $child = $this->children[$name];
        $kids[$name] = $child;
      }

      $this->children = $kids;

      return $this;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function getAttribute($name, $default = null)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }

        return $default;
    }

    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;

        return $this;
    }
    
    public function copy() {
      $_landmark = clone $this;
      $_landmark->children = array();
      $_landmark->setParent(null);
      foreach($this->getChildren() as $child)
        $_landmark->addChild($child->copy());
      
      return $_landmark;
    }

    public function slice($offset, $length = null) {
      $names = array_keys($this->getChildren());
      if($offset instanceof ItemInterface)
        $offset = $offset->getName();
      
      if(!is_numeric($offset)) 
        $offset = array_search($offset, $names);
       
      if(null !== $length) {
        if($length instanceof ItemInterface)
          $length = $length->getName();
          
        if(!is_numeric($length)) {
          $index = array_search($length, $names);
          $length = ($index < $offset) ? 0 : $index - $offset;
        }
      }
      $item = $this->copy();
      $children =  array_slice($item->getChildren(), $offset, $length);
      $item->setChildren($children);

      return $item;
    }

    public function split($length) {
      $ret = array();
      $ret['primary'] = $this->slice(0, $length);
      $ret['secondary'] = $this->slice($length);

      return $ret;
    }

    public function getLevel() {
      return $this->parent ? $this->parent->getLevel() + 1 : 0;
    }

    public function getRoot() {
      $obj = $this;
      do {
        $found = $obj;
      } while ($obj = $obj->getParent());

      return $found;
    }

    public function isRoot() {
      return null === $this->parent;
    }

    public function getParent() {
      return $this->parent;
    }

    public function setParent(ItemInterface $parent = null) {
      $this->parent = $parent;

      return $this;
    }

    public function getChildren() {
      return $this->children;
    }

    public function setChildren(array $children) {
      $this->children = $children;

      return $this;
    }

    public function removeChild($name) {
      $name = $name instanceof ItemInterface ? $name->getName() : $name;

      if(isset($this->children[$name])) {
        $this->children[$name]->setParent(null);
        unset($this->children[$name]);
      }

      return $this;
    }

    public function getFirstChild() {
      return reset($this->children);
    }

    public function getLastChild() {
      return end($this->children);
    }

    public function hasChildren() {
      return $this->children;
    }
    
    public function isLast() {
      if ($this->isRoot())  return false;

      return $this->getParent()->getLastChild() === $this;
    }

    public function isFirst() {
      if ($this->isRoot()) return false;

      return $this->getParent()->getFirstChild() === $this;
    }
    
    public function callRecursively($method, $arguments = array()) {
      call_user_func_array(array($this, $method), $arguments);

      foreach($this->children as $child)
        $child->callRecursively($method, $arguments);

      return $this;
    }

    public function toArray($depth = null) {
      $array = array(
          'name' => $this->name,
          'desciption' => $this->description,
          'latitude' => $this->latitude,
          'longitude' => $this->longtiude,
      );

      if(0 !== $depth) {
        $childDepth = (null === $depth) ? null : $depth - 1;
        $array['children'] = array();
        foreach($this->children as $key => $child)
          $array['children'][$key] = $child->toArray($childDepth);
      }

      return $array;
    }

    /**
     * Implements Countable
     */
    public function count() {
      return count($this->children);
    }

    /**
     * Implements IteratorAggregate
     */
    public function getIterator() {
      return new Itt($this->children);
    }

    /**
     * Implements ArrayAccess
     */
    public function offsetExists($name) {
      return isset($this->children[$name]);
    }

    /**
     * Implements ArrayAccess
     */
    public function offsetGet($name) {
      return $this->getChild($name);
    }

    /**
     * Implements ArrayAccess
     */
    public function offsetSet($name, $value) {
      return $this->addChild($name)->setLabel($value);
    }

    /**
     * Implements ArrayAccess
     */
    public function offsetUnset($name) {
      $this->removeChild($name);
    }
  }
