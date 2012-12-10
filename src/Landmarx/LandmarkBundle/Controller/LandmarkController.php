<?php

namespace Landmarx\LandmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LandmarkController extends Controller
{
    public function indexAction()
    {
        // get geo location of user
        // -- if logged in maybe store it in session to get faster?
      
        $landmarks = $this->get('doctrine_mongodb')
                          ->getRepository('LandmarxLandmarkBundle:Landmark');
        // delimite with a radius of the users location
        if (!$landmarks) {
          throw $this->createNotFoundException('No landmarks found.');
        }
    }
    
    public function showAction($slug)
    {
      $landmark = $this->get('doctrine_mongodb')
                       ->getRepository('LandmarxLandmarkBundle:Landmark')
                       ->findBySlug($slug);
      
      if(!$landmark)
      {
        throw $this->createNotFoundException('No landmark found.');
      }
    }
    
}
