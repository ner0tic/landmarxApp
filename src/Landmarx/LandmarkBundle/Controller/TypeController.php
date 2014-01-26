<?php
namespace Landmarx\LandmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Geocoder\Geocoder;
use Geocoder\HttpAdapter\CurlHttpAdapter;
use Geocoder\Provider\ChainProvider;
use Geocoder\Provider\GoogleMapsProvider;
use Geocoder\Provider\FreeGeoIpProvider;
use GeoPoint\Api\GeoPointApi as GP;

use Landmarx\LandmarkBundle\Document\Type;
use Landmarx\LandmarkBundle\Form\Type\TypeType;

class TypeController extends Controller
{
    /**
     * @Route("/", name="landmarx_type_show")
     * @Template("LandmarxLandmarkBundle:Type:index.html.twig")
     */
    public function indexAction()
    {
        $types = $this->get('doctrine_mongodb')
                                ->getManager()
                                ->getRepository('LandmarxLandmarkBundle:Type')
                                ->findAllOrderedByName();

        if (!$types) {
            throw $this->createNotFoundException('No types found.');
        }

        return $this->render('LandmarxLandmarkBundle:Type:index.html.twig', array('types' => $types));
    }

    /**
     * @Route("/{slug}", name="landmarx_type_show")
     * @Template("LandmarxLandmarkBundle:Type:show.html.twig")
     */
    public function showAction($slug)
    {
        $type = $this->getDoctrine()
                       ->getRepository('LandmarxLandmarkBundle:Type')
                       ->findBySlug($slug);

        if (!$type) {
            throw $this->createNotFoundException('No landmark type found.');
        }

        return $this->render(
            'LandmarxLandmarkBundle:Type:show.html.twig',
            array('type' => $type)
        );
    }

    /**
     * @Route("/new", name="landmarx_type_show")
     * @Template("LandmarxLandmarkBundle:Type:show.html.twig")
     */
    public function newAction(Request $request)
    {
        $type = new Type();
        $form = $this->createForm(new TypeType(), $type);

        if ('POST' == $request->getMethod()) {
            $form->bindRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($type);
                $em->flush();

                return $this->render(
                    'LandmarxLandmarkBundle:Type:show.html.twig',
                    array('type' => $type)
                );
            }
        }

        return $this->render(
            'LandmarxLandmarkBundle:Type:new.html.twig',
            array('form' => $form->createView())
        );
    }
}
