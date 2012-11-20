<?php

namespace Landmarx\Landmark\Tests;

use Landmarx\Landmark\LandmarkItem;

class TestLandmarkItem extends LandmarkItem {}

class LandmarkItemTreeTest extends TestCase
{
    public function testSampleTreeIntegrity()
    {
        $this->assertCount(2, $this->landmark);
        $this->assertCount(3, $this->landmark['Parent 1']);
        $this->assertCount(1, $this->landmark['Parent 2']);
        $this->assertCount(1, $this->landmark['Parent 2']['Child 4']);
        $this->assertEquals('Grandchild 1', $this->landmark['Parent 2']['Child 4']['Grandchild 1']->getName());
    }

    public function testGetLevel()
    {
        $this->assertEquals(0, $this->landmark->getLevel());
        $this->assertEquals(1, $this->pt1->getLevel());
        $this->assertEquals(1, $this->pt2->getLevel());
        $this->assertEquals(2, $this->ch4->getLevel());
        $this->assertEquals(3, $this->gc1->getLevel());
    }

    public function testGetRoot()
    {
        $this->assertSame($this->landmark, $this->landmark->getRoot());
        $this->assertSame($this->landmark, $this->pt1->getRoot());
        $this->assertSame($this->landmark, $this->gc1->getRoot());
    }

    public function testIsRoot()
    {
        $this->assertTrue($this->landmark->isRoot());
        $this->assertFalse($this->pt1->isRoot());
        $this->assertFalse($this->ch3->isRoot());
    }

    public function testGetParent()
    {
        $this->assertNull($this->landmark->getParent());
        $this->assertSame($this->landmark, $this->pt1->getParent());
        $this->assertSame($this->ch4, $this->gc1->getParent());
    }

    public function testMoveSampleLandmarkToNewRoot()
    {
        $newRoot = new TestLandmarkItem("newRoot", $this->getMock('Landmarx\Landmark\FactoryInterface'));
        $newRoot->addChild($this->landmark);

        $this->assertEquals(1, $this->landmark->getLevel());
        $this->assertEquals(2, $this->pt1->getLevel());

        $this->assertSame($newRoot, $this->landmark->getRoot());
        $this->assertSame($newRoot, $this->pt1->getRoot());
        $this->assertFalse($this->landmark->isRoot());
        $this->assertTrue($newRoot->isRoot());
        $this->assertSame($newRoot, $this->landmark->getParent());
    }

    public function testIsFirst()
    {
        $this->assertFalse($this->landmark->isFirst(), 'The root item is not considered as first');
        $this->assertTrue($this->pt1->isFirst());
        $this->assertFalse($this->pt2->isFirst());
        $this->assertTrue($this->ch4->isFirst());
    }

    public function testActsLikeFirst()
    {
        $this->ch1->setDisplay(false);
        $this->assertFalse($this->landmark->actsLikeFirst(), 'The root item is not considered as first');
        $this->assertFalse($this->ch1->actsLikeFirst(), 'A hidden item does not acts like first');
        $this->assertTrue($this->ch2->actsLikeFirst());
        $this->assertFalse($this->ch3->actsLikeFirst());
        $this->assertTrue($this->ch4->actsLikeFirst());
    }

    public function testActsLikeFirstWithNoDisplayedItem()
    {
        $this->pt1->setDisplay(false);
        $this->pt2->setDisplay(false);
        $this->assertFalse($this->pt1->actsLikeFirst());
        $this->assertFalse($this->pt2->actsLikeFirst());
    }

    public function testIsLast()
    {
        $this->assertFalse($this->landmark->isLast(), 'The root item is not considered as last');
        $this->assertFalse($this->pt1->isLast());
        $this->assertTrue($this->pt2->isLast());
        $this->assertTrue($this->ch4->isLast());
    }

    public function testActsLikeLast()
    {
        $this->ch3->setDisplay(false);
        $this->assertFalse($this->landmark->actsLikeLast(), 'The root item is not considered as last');
        $this->assertFalse($this->ch1->actsLikeLast());
        $this->assertTrue($this->ch2->actsLikeLast());
        $this->assertFalse($this->ch3->actsLikeLast(), 'A hidden item does not acts like last');
        $this->assertTrue($this->ch4->actsLikeLast());
    }

    public function testActsLikeLastWithNoDisplayedItem()
    {
        $this->pt1->setDisplay(false);
        $this->pt2->setDisplay(false);
        $this->assertFalse($this->pt1->actsLikeLast());
        $this->assertFalse($this->pt2->actsLikeLast());
    }

    public function testArrayAccess()
    {
        $this->landmark->addChild('Child Landmark');
        $this->assertEquals('Child Landmark', $this->landmark['Child Landmark']->getName());
        $this->assertNull($this->landmark['Fake']);

        $this->landmark['New Child'] = 'New Label';
        $this->assertEquals('Landmarx\Landmark\LandmarkItem', get_class($this->landmark['New Child']));
        $this->assertEquals('New Child', $this->landmark['New Child']->getName());
        $this->assertEquals('New Label', $this->landmark['New Child']->getLabel());

        unset($this->landmark['New Child']);
        $this->assertNull($this->landmark['New Child']);
    }

    public function testCountable()
    {
        $this->assertCount(2, $this->landmark);

        $this->landmark->addChild('New Child');
        $this->assertCount(3, $this->landmark);

        unset($this->landmark['New Child']);
        $this->assertCount(2, $this->landmark);
    }

    public function testGetChildren()
    {
        $children = $this->ch4->getChildren();
        $this->assertCount(1, $children);
        $this->assertEquals($this->gc1->getName(), $children['Grandchild 1']->getName());
    }

    public function testGetFirstChild()
    {
        $this->assertSame($this->pt1, $this->landmark->getFirstChild());
        // test for bug in getFirstChild implementation (when internal array pointer is changed getFirstChild returns wrong child)
        foreach ($this->landmark->getChildren() as $c);
        $this->assertSame($this->pt1, $this->landmark->getFirstChild());
    }

    public function testGetLastChild()
    {
        $this->assertSame($this->pt2, $this->landmark->getLastChild());
        // test for bug in getFirstChild implementation (when internal array pointer is changed getLastChild returns wrong child)
        foreach ($this->landmark->getChildren() as $c);
        $this->assertSame($this->pt2, $this->landmark->getLastChild());
    }

    public function testAddChildDoesNotUSeTheFactoryIfItem()
    {
        $factory = $this->getMock('Landmarx\Landmark\FactoryInterface');
        $factory->expects($this->never())
            ->method('createItem');
        $landmark = new LandmarkItem('Root li', $factory);
        $landmark->addChild(new LandmarkItem('Child 3', $factory));
    }

    /**
     * @expectedException LogicException
     */
    public function testAddChildFailsIfInAnotherLandmark()
    {
        $factory = $this->getMock('Landmarx\Landmark\FactoryInterface');
        $landmark = new LandmarkItem('Root li', $factory);
        $child = new LandmarkItem('Child 3', $factory);
        $landmark->addChild($child);

        $landmark2 = new LandmarkItem('Second landmark', $factory);
        $landmark2->addChild($child);
    }

    public function testGetChild()
    {
        $this->assertSame($this->gc1, $this->ch4->getChild('Grandchild 1'));
        $this->assertNull($this->ch4->getChild('nonexistentchild'));
    }

    public function testRemoveChild()
    {
        $gc2 = $this->ch4->addChild('gc2');
        $gc3 = $this->ch4->addChild('gc3');
        $gc4 = $this->ch4->addChild('gc4');
        $this->assertCount(4, $this->ch4);
        $this->ch4->removeChild('gc4');
        $this->assertCount(3, $this->ch4);
        $this->assertTrue($this->ch4->getChild('Grandchild 1')->isFirst());
        $this->assertTrue($this->ch4->getChild('gc3')->isLast());
    }

    public function testRemoveFakeChild()
    {
        $this->landmark->removeChild('fake');
        $this->assertCount(2, $this->landmark);
    }

    public function testReAddRemovedChild()
    {
        $gc2 = $this->ch4->addChild('gc2');
        $this->ch4->removeChild('gc2');
        $this->landmark->addChild($gc2);
        $this->assertCount(3, $this->landmark);
        $this->assertTrue($gc2->isLast());
        $this->assertFalse($this->pt2->isLast());
    }

    public function testUpdateChildAfterRename()
    {
        $this->pt1->setName('Temp name');
        $this->assertSame($this->pt1, $this->landmark->getChild('Temp name'));
        $this->assertEquals(array('Temp name', 'Parent 2'), array_keys($this->landmark->getChildren()));
        $this->assertNull($this->landmark->getChild('Parent 1'));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testRenameToExistingSiblingNameThrowAnException()
    {
        $this->pt1->setName('Parent 2');
    }

    /**
     * @dataProvider getSliceData
     */
    public function testSlice($offset, $length, $count, $keys)
    {
        $sliced = $this->pt1->slice($offset, $length);
        $this->assertCount($count, $sliced);
        $this->assertEquals($keys, array_keys($sliced->getChildren()));
    }

    public function getSliceData()
    {
        $this->setUp();

        return array(
            'numeric offset and numeric length' => array(0, 2, 2, array($this->ch1->getName(), $this->ch2->getName())),
            'numeric offset and no length' => array(0, null, 3, array($this->ch1->getName(), $this->ch2->getName(), $this->ch3->getName())),
            'named offset and no length' => array('Child 2', null, 2, array($this->ch2->getName(), $this->ch3->getName())),
            'child offset and no length' => array($this->ch3, null, 1, array($this->ch3->getName())),
            'numeric offset and named length' => array(0, 'Child 3', 2, array($this->ch1->getName(), $this->ch2->getName())),
            'numeric offset and child length' => array(0, $this->ch3, 2, array($this->ch1->getName(), $this->ch2->getName())),
        );
    }

    /**
     * @dataProvider getSplitData
     */
    public function testSplit($length, $count, $keys)
    {
        $splitted = $this->pt1->split($length);
        $this->assertArrayHasKey('primary', $splitted);
        $this->assertArrayHasKey('secondary', $splitted);
        $this->assertCount($count, $splitted['primary']);
        $this->assertCount(3 - $count, $splitted['secondary']);
        $this->assertEquals($keys, array_keys($splitted['primary']->getChildren()));
    }

    public function getSplitData()
    {
        $this->setUp();

        return array(
            'numeric length' => array(1, 1, array($this->ch1->getName())),
            'named length' => array('Child 3', 2, array($this->ch1->getName(), $this->ch2->getName())),
            'child length' => array($this->ch3, 2, array($this->ch1->getName(), $this->ch2->getName())),
        );
    }

    public function testPathAsString()
    {
        $this->assertEquals('Root li > Parent 2 > Child 4', $this->ch4->getPathAsString(), 'Path with default separator');
        $this->assertEquals('Root li / Parent 1 / Child 2', $this->ch2->getPathAsString(' / '), 'Path with custom separator');
    }

    

    protected function addChildWithExternalUrl()
    {
        $this->landmark->addChild('child', array('uri' => 'http://www.symfony-reloaded.org'));
    }
}