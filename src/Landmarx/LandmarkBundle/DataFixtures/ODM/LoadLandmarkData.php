<?php
namespace Landmarx\LandmarkBundle\DataFixtures\ODM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Landmarx\LandmarkBundle\Entity\Landmark;

class LoadLandmarkData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $landmarkAppalachianMtnRng = new Landmark();
        $landmarkAppalachianMtnRng->setName('appalachian mountain range');
        $landmarkAppalachianMtnRng->setDescription('appalachian mountain range');

        $manager->persist($landmarkAppalachianMtnRng);
        $this->addReference('landmark-appalachianmtnrng', $landmarkAppalachianMtnRng);

        $landmarkMtnKatahdin = new Landmark();
        $landmarkMtnKatahdin->setName('katahdin');
        $landmarkMtnKatahdin->setDescription('katahdin');

        $manager->persist($landmarkMtnKatahdin);
        $this->addReference('landmark-mtn-katahdin', $landmarkMtnKatahdin);

        $landmarkMtnKatahdin = new Landmark();
        $landmarkMtnKatahdin->setName('appalachian trail');
        $landmarkMtnKatahdin->setDescription('appalachian trail');
        $landmarkMtnKatahdin->setParent($this->getReference('landmark-appalachianmtnrng'));

        $manager->persist($landmarkMtnKatahdin);
        $this->addReference('type-mtn-lone', $landmarkMtnKatahdin);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }
}
