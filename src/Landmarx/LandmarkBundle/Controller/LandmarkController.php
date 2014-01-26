<?php
namespace Landmarx\LandmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

use Geocoder\Geocoder;
use Geocoder\HttpAdapter\CurlHttpAdapter;
use Geocoder\Provider\ChainProvider;
use Geocoder\Provider\GoogleMapsProvider;
use Geocoder\Provider\FreeGeoIpProvider;
use GeoPoint\Api\GeoPointApi as GP;

use Landmarx\LandmarkBundle\Document\Landmark;
use Landmarx\LandmarkBundle\Form\Type\LandmarkType;
use Landmarx\LandmarkBundle\Form\Type\LandmarkSearchType;

class LandmarkController extends Controller
{
    /**
     * @Route("/", name="landmarx_landmark_index")
     * @Template("LandmarxLandmarkBundle:Landmark:index.html.twig")
     */
    public function indexAction()
    {
        // get geo location of user
        $gp = new GP();
        /**
         * @todo  temp hardcode the key and secret
         */
        $gp->getClient()
           ->setApiKey('120.1.517bcf11e4b0a3353cbcc9a7.3LO8lVZsV')
           ->setSecret('ilO81G2p');

        $ip = $_SERVER['REMOTE_ADDR'];

        if (in_array($ip, array('127.0.0.1', '10.10.0.1'))) {
            $ip = '74.7.133.89';
        }

        $ipinfo = $gp->get($ip);
        /**
        $current = array(
            $ipinfo[ 'ipinfo' ][ 'Location' ][ 'latitude' ],
            $ipinfo[ 'ipinfo' ][ 'Location' ][ 'longitude' ]
        );
        */
        $current = '';
        if (!is_array($current) || 2 != count($current)) {
            $NotValidCurrentPageExceptiont = array(43.754419, -70.409296);
        }

        $landmarks = $this->get('doctrine_mongodb')
                                ->getManager()
                                ->getRepository('LandmarxLandmarkBundle:Landmark')
                                ->findAllOrderedByName();

        // delimite with a radius of the users location here

        if (!$landmarks) {
            throw $this->createNotFoundException('No landmarks found.');
        }

        return $this->render(
            'LandmarxLandmarkBundle:Landmark:index.html.twig',
            array(
                'landmarks' => $landmarks,
                'current' => $current
          )
        );
    }

    /**
     * @Route("/{slug}", name="landmarx_landmark_show")
     * @Template("LandmarxLandmarkBundle:Landmark:show.html.twig")
     */
    public function showAction($slug)
    {
        $landmark = $this->get('doctrine_mongodb')
                         ->getManager()
                         ->getRepository('LandmarxLandmarkBundle:Landmark')
                         ->findBySlug($slug);

        if (!$landmark) {
            throw $this->createNotFoundException('No landmark found.');
        }

        return $this->render(
            'LandmarxLandmarkBundle:Landmark:show.html.twig',
            array('landmark' => $landmark)
        );
    }

    /**
     * @Route("/new", name="landmarx_landmark_new")
     * @Template("LandmarxLandmarkBundle:Landmark:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $landmark = new Landmark();
        $form = $this->createForm(new LandmarkType());

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $dm = $this->get('doctrine_mongodb')->getManager();
                $dm->persist($landmark);
                $dm->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'landmark added.'
                );

                return $this->render(
                    'LandmarxLandmarkBundle:Landmark:show.html.twig',
                    array('landmark' => $landmark)
                );
            }

            return array('form' => $form->createView());
        }
    }
}
