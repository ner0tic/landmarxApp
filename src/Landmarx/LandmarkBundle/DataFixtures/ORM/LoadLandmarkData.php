<?php
    namespace Landmarx\LandmarkBundle\DataFixtures\ORM;

    use Doctrine\Common\Persistence\ObjectManager,
        Doctrine\Common\DataFixtures\AbstractFixture,
        Doctrine\Common\DataFixtures\OrderedFixtureInterface,
        Landmarx\LandmarkBundle\Entity\Landmark;

    class LoadLandmarkData extends AbstractFixture implements OrderedFixtureInterface
    {
        /**
         * {@inheritDoc}
         */
        public function load( ObjectManager $manager )
        {
            ////////////////////////////////////////////////////////////////////
            // Katahdin ////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $katahdin = new Landmark();
            $katahdin->setName( 'katahdin' );
            $katahdin->setDescription( 'mt katahdin.' );
            $katahdin->setLatitude( 45.9044 );
            $katahdin->setLongitude( 68.9213 );
            $katahdin->setKind( $this->getReference( 'mtn' ) );
            $katahdin->setPublic( true );
            $manager->persist( $katahdin );
            $this->addReference( 'mt-katahdin', $katahdin );

            ////////////////////////////////////////////////////////////////////
            // Androscoggin ////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $androscoggin = new Landmark();
            $androscoggin->setName( 'androscoggin' );
            $androscoggin->setDescription( 'androscoggin river.' );
            $androscoggin->setLatitude( 44.7825 );
            $androscoggin->setLongitude(  -71.1294 );
            $androscoggin->setKind( $this->getReference( 'river' ) );
            $androscoggin->setPublic( true );
            $manager->persist( $androscoggin );
            $this->addReference( 'androscoggin', $androscoggin );
            
            ////////////////////////////////////////////////////////////////////
            // Abol Trail //////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $abol_trail = new Landmark();
            $abol_trail->setName( 'abol trail' );
            $abol_trail->setDescription( 'abol trail.' );
            $abol_trail->setLatitude( 45.897268 );
            $abol_trail->setLongitude( -68.9619902 );
            $abol_trail->setKind( $this->getReference( 'hiking-trail' ) );
            $abol_trail->setPublic( true );
            $manager->persist( $abol_trail );
            $this->addReference( 'abol-trail', $abol_trail );
            
            ////////////////////////////////////////////////////////////////////
            // Katahdin :: Baxter Peak /////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $baxter_peak = new Landmark();
            $baxter_peak->setName( 'baxter peak ');
            $baxter_peak->setDescription( 'baxter peak.' );
            $baxter_peak->setLatitude( 45.904362 );
            $baxter_peak->setLongitude( -68.921392 );
            $baxter_peak->setKind( $this->getReference( 'mtn-peak' ) );
            $baxter_peak->setParent( $this->getReference( 'mt-katahdin' ) );
            $baxter_peak->setPublic( true );
            $manager->persist( $baxter_peak );
            $this->addReference( 'baxter-peak', $baxter_peak );
        }
        
        public function getOrder() { return 2; }
    }