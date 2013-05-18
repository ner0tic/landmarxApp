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
    GeoPoint\Api\GeoPointApi as GP,
    Landmarx\LandmarkBundle\Entity\LandmarkKind,
    Landmarx\LandmarkBundle\Form\Type\LandmarkKindType;

class LandmarkKindController extends Controller
{
    /**
     * 
     * @return render
     * @throws NotFoundException
     */
    public function indexAction()
    {
        $kinds = $this->get( 'doctrine' )
                          ->getRepository( 'LandmarxLandmarkBundle:LandmarkKind' );
        
        if ( !$kinds ) {
          throw $this->createNotFoundException( 'No kinds found.' );
        }
        
        return $this->render( 'LandmarxLandmarkBundle:LandmarkKind:index.html.twig', array('kinds' => $kinds ) );
    }
    
    /**
     * 
     * @param string $slug
     * @return return
     * @throws NotFoundException
     */
    public function showAction( $slug )
    {
      $kind = $this->getDoctrine()
                       ->getRepository( 'LandmarxLandmarkBundle:LandmarkKind' )
                       ->findBySlug( $slug );
      
      if( !$kind )
      {
        throw $this->createNotFoundException( 'No landmark kind found.' );
      }
      
      return $this->render( 'LandmarxLandmarkBundle:LandmarkKind:show.html.twig', array('kind' => $kind ) );
    }
 
    public function newAction( Request $request ) 
    {
        $kind = new LandmarkKind();
        $form = $this->createForm( new LandmarkKindType(), $kind );

        if ( $request->getMethod() == 'POST' ) 
        {
            $form->bindRequest( $this->getRequest() );
            if( $form->isValid() ) 
            {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist( $kind );
                $em->flush();

              return $this->render( 'LandmarxLandmarkBundle:LandmarkKind:show.html.twig', array(
                  'kind' => $kind
              ));
            }
        }

        return $this->render( 'LandmarxLandmarkBundle:LandmarkKind:new.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
