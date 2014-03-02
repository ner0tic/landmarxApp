<?php
namespace Landmarx\LandmarkBundle\DataFixtures\ODM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Landmarx\LandmarkBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $categoryHikingTrl = new Category();
        $categoryHikingTrl->setName('hiking trail');
        $categoryHikingTrl->setDescription('hiking trail');

        $manager->persist($categoryHikingTrl);
        $this->addReference('category-HikingTrl', $categoryHikingTrl);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4;
    }
}
