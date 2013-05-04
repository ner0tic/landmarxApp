<?php

namespace Landmarx\LandmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Symfony\Component\HttpFoundation\Request,
        
    Geocoder\Geocoder,
    Geocoder\HttpAdapter\CurlHttpAdapter,
    Geocoder\Provider\ChainProvider,
    Geocoder\Provider\GoogleMapsProvider,
    Geocoder\Provider\FreeGeoIpProvider,
        
    GeoPoint\Api\GeoPointApi as GP;

class LandmarkController extends Controller
{
    /**
     * 
     * @return render
     * @throws NotFoundException
     */
    public function indexAction()
    {
        // get geo location of user
        $gp = new GP();
        $gp->getClient()
           ->setApiKey( '120.1.517bcf11e4b0a3353cbcc9a7.3LO8lVZsV' )
           ->setSecret( 'ilO81G2p' );
        
        $ip = $_SERVER[ 'REMOTE_ADDR' ];
        
        if( in_array( $ip, array( '127.0.0.1', '10.10.0.1' ) ) )
            $ip = '74.7.133.89';
                
        $ipinfo = $gp->get( $ip );
        
        var_dump($ipinfo); die('---');
        
        $current = array( $ipinfo->Location->latitude, $ipinfo->Location->longitude );
        if( !is_array( $current ) || count( $current ) != 2 )
        {
            $current = array( 43.754419, -70.409296 );
        }
        
        $landmarks = $this->get( 'doctrine' )
                          ->getRepository( 'LandmarxLandmarkBundle:Landmark' );
        // delimite with a radius of the users location here
        
        if ( !$landmarks ) {
          throw $this->createNotFoundException( 'No landmarks found.' );
        }
        
        return $this->render( 'LandmarxLandmarkBundle:Landmark:index.html.twig', array('landmarks' => $landmarks, 'current' => $current ) );
    }
    
    /**
     * 
     * @param string $slug
     * @return return
     * @throws NotFoundException
     */
    public function showAction( $slug )
    {
      $landmark = $this->get( 'doctrine_mongodb' )
                       ->getRepository( 'LandmarxLandmarkBundle:Landmark' )
                       ->findBySlug( $slug );
      
      if( !$landmark )
      {
        throw $this->createNotFoundException( 'No landmark found.' );
      }
      
      return $this->render( 'LandmarxLandmarkBundle:Landmark:show.html.twig', array('landmark' => $landmark ) );
    }
 
    public function newAction( Request $request ) 
    {
        $landmark = new Landmark();
        $form = $this->createFormBuilder( $landmark )
              ->add('name')
              ->add('description')
              ->add('categories')
              ->add('parent')
              ->add('latlng', new GoogleMapType())
              ->getForm();

        if ( $request->getMethod() == 'POST' ) 
        {
            $form->bindRequest( $this->getRequest() );
            if( $form->isValid() ) 
            {
                $em = $this->get('doctrine_mongodb')->getManager();
                $em->persist( $landmark);
                $em->flush();

                return $this->redirect( $this->generateUrl('landmarks') );
            }
        }
        
        return $this->render( 'LandmarxLandmarkBundle:Landmark:new.html.twig', array( 'form' => $form->createView() ) );
    }
}
