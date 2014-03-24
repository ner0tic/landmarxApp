<?php
namespace Landmarx\UtilityBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Landmarx\UtilityBundle\Controller\UtilityController as Controller;

class HomepageController extends Controller
{
    /**
     * @Template("LandmarxUtilityBundle:Homepage:index.html.twig")
     */
    public function indexAction()
    {
        // Carousel
        $carousel = $this->getDoctrine()
            ->getRepository('LandmarxUtilityBundle:Carousel')
            ->findOneBySlug('splash');
    

        // last username entered by the user
        $lastUsername = (!$this->securityContext->isGranted('ROLE_USER')) ? '' : $this->securityContext->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->has('form.csrf_provider')
            ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
            : null;

        return array(
            'carousel' => $carousel,
            'csrf_token' => $csrfToken,
            'last_username' => $lastUsername
        );
    }

    public function aboutAction()
    {
        return $this->render('LandmarxUtilityBundle:Homepage:about.html.twig');
    }

    public function helpAction()
    {
        return $this->render('LandmarxUtilityBundle:Homepage:help.html.twig');
    }

    public function contactAction()
    {
        return $this->render('LandmarxUtilityBundle:Homepage:contact.html.twig');
    }
}