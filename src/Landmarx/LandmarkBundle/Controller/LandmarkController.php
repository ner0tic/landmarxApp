<?php
namespace Landmarx\LandmarkBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineODMMongoDBAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

use Landmarx\UtilityBundle\Controller\UtilityController as Controller;
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
        $query = $this->get('doctrine_mongodb')
                                ->getRepository('LandmarxLandmarkBundle:Landmark')
                                ->createQueryBuilder('l');

        $pager = new Pagerfanta(new DoctrineODMMongoDBAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 10));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
            'landmarks' => $pager->getCurrentPageResults(),
            'current' => $current,
            'pager' => $pager
        );
    }

    /**
     * @Route("/nearby", name="landmarx_landmark_nearby")
     * @Template("LandmarxLandmarkBundle:Landmark:index.html.twig")
     */
    public function nearbyAction()
    {       
        $current = $this->ipinfo['ipinfo']['Location'];
        
        if (!is_array($current)) {
            $current = array(
                'latitude' => 43.754419, 
                'longitude' => -70.409296);
            $this->get('session')->getFlashBag()->add(
                'warning',
                'your location could not accurately be determined. Default coordinates have been used.'
            );
        }

        $radius = $this->getRequest()->get('radius', 25);

        $query = $this->get('doctrine_mongodb')
                                ->getRepository('LandmarxLandmarkBundle:Landmark')
                                ->createQueryBuilder('l')
                                ->field('coordinates')
                                ->geoNear(
                                    $current['latitude'],
                                    $current['longitude']
                                )
                                ->spherical(true)
                                ->distanceMultiplier(3963.192) // 3963.192 miles |  6378.137 for km
                                ->maxDistance($radius);

        $pager = new Pagerfanta(new DoctrineODMMongoDBAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 10));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
            'landmarks' => $pager->getCurrentPageResults(),
            'current' => $current,
            'pager' => $pager
        );
    }

    /**
     * @Route("/new", name="landmarx_landmark_new")
     * @Template("LandmarxLandmarkBundle:Landmark:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $landmark = new Landmark();
        $form = $this->createForm(new LandmarkType(), $landmark);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $dm = $this->get('doctrine_mongOdb')->getManager();
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

    /**
     * @Route("/search", name="landmarx_landmark_search")
     * @Template("LandmarxLandmarkBundle:Landmark:search.html.twig")
     */
    public function searchAction(Request $request)
    {
        
    }

    /**
     * @Route("/{slug}", name="landmarx_landmark_show")
     * @Template("LandmarxLandmarkBundle:Landmark:show.html.twig")
     */
    public function showAction($slug)
    {
        $landmark = $this->get('doctrine_mongodb')
                         ->getRepository('LandmarxLandmarkBundle:Landmark')
                         ->findOneBySlug($slug);

        if (!$landmark) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'no matching landmark found.'
            );
            $this->redirect($this->generateUrl('landmarx_landmark_index'));
        }

        return array('landmark' => $landmark);
    }
}
