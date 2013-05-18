<?php
    namespace Acme\HelloBundle\DataFixtures\ORM;

    use Doctrine\Common\Persistence\ObjectManager,
        Doctrine\Common\DataFixtures\AbstractFixture,
        Doctrine\Common\DataFixtures\OrderedFixtureInterface,
        Landmarx\LandmarkBundle\Entity\LandmarkKind;

    class LoadLandmarkKindData extends AbstractFixture implements OrderedFixtureInterface
    {
        /**
         * {@inheritDoc}
         */
        public function load( ObjectManager $manager )
        {
            ////////////////////////////////////////////////////////////////////
            // Mountain ////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $mtn = new LandmarkKind();
            $mtn->setName( 'mountain' );
            $mtn->setDescription( 'a mountain.' );
            $mtn->setPublic( true );
            $manager->persist( $mtn );
            $this->addReference( 'mtn', $mtn );

            ////////////////////////////////////////////////////////////////////
            // Mountain :: Peak ////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $mtn_peak = new LandmarkKind();
            $mtn_peak->setName( 'mountain peak' );
            $mtn_peak->setDescription( 'a mountain peak.' );
            $mtn_peak->setPublic( true );
            $mtn_peak->setParent( $this->getReference( 'mtn' ) );
            $manager->persist( $mtn_peak );
            $this->addReference( 'mtn-peak', $mtn_peak );

            ////////////////////////////////////////////////////////////////////
            // River ///////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $river = new LandmarkKind();
            $river->setName( 'river' );
            $river->setDescription( 'a river.' );
            $river->setPublic( true );
            $manager->persist( $river );
            $this->addReference( 'river', $river );

            ////////////////////////////////////////////////////////////////////
            // Stream //////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $stream = new LandmarkKind();
            $stream->setName( 'stream' );
            $stream->setDescription( 'a stream.' );
            $stream->setPublic( true );
            $manager->persist( $stream );
            $this->addReference( 'stream', $stream );

            ////////////////////////////////////////////////////////////////////
            // Brook ///////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $brook = new LandmarkKind();
            $brook->setName( 'brook' );
            $brook->setDescription( 'a brook.' );
            $brook->setPublic( true );
            $manager->persist( $brook );
            $this->addReference( 'brook', $brook );

            ////////////////////////////////////////////////////////////////////
            // Trail ///////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $trail = new LandmarkKind();
            $trail->setName( 'mountain peak' );
            $trail->setDescription( 'a trail.' );
            $trail->setPublic( true );
            $manager->persist( $trail );
            $this->addReference( 'trail', $trail );

            ////////////////////////////////////////////////////////////////////
            // Trail :: Hiking /////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $hiking_trail = new LandmarkKind();
            $hiking_trail->setName( 'hiking trail' );
            $hiking_trail->setDescription( 'a hiking trail.' );
            $hiking_trail->setPublic( true );
            $hiking_trail->setParent( $this->getReference( 'trail' ) );
            $manager->persist( $hiking_trail );
            $this->addReference( 'hiking-trail', $hiking_trail );

            ////////////////////////////////////////////////////////////////////
            // Trail :: ATV ////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $atv_trail = new LandmarkKind();
            $atv_trail->setName( 'atv trail' );
            $atv_trail->setDescription( 'an atv trail.' );
            $atv_trail->setPublic( true );
            $atv_trail->setParent( $this->getReference( 'trail' ) );
            $manager->persist( $atv_trail );
            $this->addReference( 'atv-trail', $atv_trail );

            $manager->flush();
        }

        public function getOrder() { return 1; }
    }