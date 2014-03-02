<?php
namespace Landmarx\LandmarkBundle\DataFixtures\ODM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Landmarx\LandmarkBundle\Entity\Type;

class LoadTypeData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $typeMtnRng = new Type();
        $typeMtnRng->setName('mountain range');
        $typeMtnRng->setDescription('mountain range');

        $manager->persist($typeMtnRng);
        $this->addReference('type-mtnrng', $typeMtnRng);

        $typeMtn = new Type();
        $typeMtn->setName('mountain');
        $typeMtn->setDescription('mountain');

        $manager->persist($typeMtn);
        $this->addReference('type-mtn', $typeMtn);

        $typeMtnLone = new Type();
        $typeMtnLone->setName('lone mountain');
        $typeMtnLone->setDescription('lone mountain');
        $typeMtnLone->setParent($this->getReference('type-mtn'));

        $manager->persist($typeMtnLone);
        $this->addReference('type-mtn-lone', $typeMtnLone);

        $typeMtnInRng = new Type();
        $typeMtnInRng->setName('mountain within a range');
        $typeMtnInRng->setDescription('mountain within a range');
        $typeMtnInRng->setParent($this->getReference('type-mtnrng'));

        $manager->persist($typeMtnInRng);
        $this->addReference('type-mtn-in-rng', $typeMtnInRng);

        $typeTrail = new Type();
        $typeTrail->setName('trail');
        $typeTrail->setDescription('trail');

        $manager->persist($typeTrail);
        $this->addReference('type-trail', $typeTrail);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
}
