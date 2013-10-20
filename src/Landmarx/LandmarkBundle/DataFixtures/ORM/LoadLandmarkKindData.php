<?php
    namespace Acme\HelloBundle\DataFixtures\ORM;

    use Doctrine\Common\Persistence\ObjectManager,
        Doctrine\Common\DataFixtures\AbstractFixture,
        Doctrine\Common\DataFixtures\OrderedFixtureInterface,
        Landmarx\LandmarkBundle\Entity\Kind;

    class LoadKindData extends AbstractFixture implements OrderedFixtureInterface
    {
        /**
         * {@inheritDoc}
         */
        public function load(ObjectManager $manager)
        {
            ////////////////////////////////////////////////////////////////////
            // Mountain ////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $mtn = new Kind();
            $mtn->setName('mountain');
            $mtn->setDescription('a mountain.');
            $mtn->setPublic(true);
            $manager->persist($mtn);
            $this->addReference('mtn', $mtn);

            ////////////////////////////////////////////////////////////////////
            // Mountain :: Peak ////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $mtn_peak = new Kind();
            $mtn_peak->setName('mountain peak');
            $mtn_peak->setDescription('a mountain peak.');
            $mtn_peak->setPublic(true);
            $mtn_peak->setParent($this->getReference('mtn'));
            $manager->persist($mtn_peak);
            $this->addReference('mtn-peak', $mtn_peak);

            ////////////////////////////////////////////////////////////////////
            // River ///////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $river = new Kind();
            $river->setName('river');
            $river->setDescription('a river.');
            $river->setPublic(true);
            $manager->persist($river);
            $this->addReference('river', $river);

            ////////////////////////////////////////////////////////////////////
            // Stream //////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $stream = new Kind();
            $stream->setName('stream');
            $stream->setDescription('a stream.');
            $stream->setPublic(true);
            $manager->persist($stream);
            $this->addReference('stream', $stream);

            ////////////////////////////////////////////////////////////////////
            // Brook ///////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $brook = new Kind();
            $brook->setName('brook');
            $brook->setDescription('a brook.');
            $brook->setPublic(true);
            $manager->persist($brook);
            $this->addReference('brook', $brook);

            ////////////////////////////////////////////////////////////////////
            // Trail ///////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $trail = new Kind();
            $trail->setName('mountain peak');
            $trail->setDescription('a trail.');
            $trail->setPublic(true);
            $manager->persist($trail);
            $this->addReference('trail', $trail);

            ////////////////////////////////////////////////////////////////////
            // Trail :: Hiking /////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $hiking_trail = new Kind();
            $hiking_trail->setName('hiking trail');
            $hiking_trail->setDescription('a hiking trail.');
            $hiking_trail->setPublic(true);
            $hiking_trail->setParent($this->getReference('trail'));
            $manager->persist($hiking_trail);
            $this->addReference('hiking-trail', $hiking_trail);

            ////////////////////////////////////////////////////////////////////
            // Trail :: ATV ////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $atv_trail = new Kind();
            $atv_trail->setName('atv trail');
            $atv_trail->setDescription('an atv trail.');
            $atv_trail->setPublic(true);
            $atv_trail->setParent($this->getReference('trail'));
            $manager->persist($atv_trail);
            $this->addReference('atv-trail', $atv_trail);

            $manager->flush();
        }

        public function getOrder() { return 1; }
    }
