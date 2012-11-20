<?php

namespace Landmarx\Landmark\Tests;

use Landmarx\Landmark\LandmarkItem;
use Landmarx\Landmark\LandmarkFactory;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Landmarx\Landmark\LandmarkItem
     */
    protected $landmark;

    /**
     * @var \Landmarx\Landmark\LandmarkItem
     */
    protected $pt1;

    /**
     * @var \Landmarx\Landmark\LandmarkItem
     */
    protected $ch1;

    /**
     * @var \Landmarx\Landmark\LandmarkItem
     */
    protected $ch2;

    /**
     * @var \Landmarx\Landmark\LandmarkItem
     */
    protected $ch3;

    /**
     * @var \Landmarx\Landmark\LandmarkItem
     */
    protected $pt2;

    /**
     * @var \Landmarx\Landmark\LandmarkItem
     */
    protected $ch4;

    /**
     * @var \Landmarx\Landmark\LandmarkItem
     */
    protected $gc1;

    protected function setUp()
    {
        $factory = new LandmarkFactory();
        $this->landmark = $factory->createItem('Root li', array('childrenAttributes' => array('class' => 'root')));
        $this->pt1 = $this->landmark->addChild('Parent 1');
        $this->ch1 = $this->pt1->addChild('Child 1');
        $this->ch2 = $this->pt1->addChild('Child 2');

        // add the 3rd child via addChild with an object
        $this->ch3 = new LandmarkItem('Child 3', $factory);
        $this->pt1->addChild($this->ch3);

        $this->pt2 = $this->landmark->addChild('Parent 2');
        $this->ch4 = $this->pt2->addChild('Child 4');
        $this->gc1 = $this->ch4->addChild('Grandchild 1');
    }

    protected function tearDown()
    {
        $this->landmark = null;
        $this->pt1 = null;
        $this->ch1 = null;
        $this->ch2 = null;
        $this->ch3 = null;
        $this->pt2 = null;
        $this->ch4 = null;
        $this->gc1 = null;
    }

    // prints a visual representation of our basic testing tree
    protected function printTestTree()
    {
        print('      Landmark Structure   '."\n");
        print('               rt      '."\n");
        print('             /    \    '."\n");
        print('          pt1      pt2 '."\n");
        print('        /  | \      |  '."\n");
        print('      ch1 ch2 ch3  ch4 '."\n");
        print('                    |  '."\n");
        print('                   gc1 '."\n");
    }
}