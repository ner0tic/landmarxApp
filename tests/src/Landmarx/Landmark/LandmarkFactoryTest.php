<?php

namespace Landmarx\Landmark\Tests;

use Landmarx\Landmark\LandmarkFactory;

class LandmarkFactoryTest extends \PHPUnit_Framework_TestCase {

  public function testFromArrayWithoutChildren() {
    $factory = new LandmarkFactory();
    $array = array(
        'name' => 'joe',
        'description' => 'foobar',
    );
    $item = $factory->createFromArray($array);
    $this->assertEquals('joe', $item->getName());
    $this->assertEquals('foobar', $item->getDescription());
    $this->assertEmpty($item->getAttributes());
    $this->assertEmpty($item->getChildren());
  }

  public function testFromArrayWithChildren() {
    $factory = new LandmarkFactory();
    $array = array(
        'name' => 'joe',
        'children' => array(
            'jack' => array(
                'name' => 'jack',
                'label' => 'Jack',
            ),
            array(
                'name' => 'john'
            )
        ),
    );
    $item = $factory->createFromArray($array);
    $this->assertEquals('joe', $item->getName());
    $this->assertEmpty($item->getAttributes());
    $this->assertCount(2, $item);
    $this->assertTrue(isset($item['john']));
  }

  public function testFromArrayWithChildrenOmittingName() {
    $factory = new LandmarkFactory();
    $array = array(
        'name' => 'joe',
        'children' => array(
            'jack' => array(
                'label' => 'Jack',
            ),
            'john' => array(
                'label' => 'John'
            )
        ),
    );
    $item = $factory->createFromArray($array);
    $this->assertEquals('joe', $item->getName());
    $this->assertEmpty($item->getAttributes());
    $this->assertCount(2, $item);
    $this->assertTrue(isset($item['john']));
    $this->assertTrue(isset($item['jack']));
  }

}