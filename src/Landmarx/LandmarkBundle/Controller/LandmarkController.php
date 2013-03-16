<?php

namespace Landmarx\LandmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

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
        // -- if logged in maybe store it in session to get faster?
        $current = array(
            'lat' => 43.754419,
            'lng' => -70.409296
        );
      
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
