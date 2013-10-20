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
use Landmarx\LandmarkBundle\Document\Kind;
use Landmarx\LandmarkBundle\Form\Type\KindType;

class KindController extends Controller
{
    /**
     *
     * @return render
     * @throws NotFoundException
     */
    public function indexAction()
    {
        $kinds = $this;

        if (!$kinds) {
            throw $this->createNotFoundException('No kinds found.');
        }

        return $this->render('LandmarxLandmarkBundle:Kind:index.html.twig', array('kinds' => $kinds));
    }

    /**
     *
     * @param string $slug
     * @return return
     * @throws NotFoundException
     */
    public function showAction($slug)
    {
        $kind = $this->getDoctrine()
                       ->getRepository('LandmarxLandmarkBundle:Kind')
                       ->findBySlug($slug);

        if (!$kind) {
            throw $this->createNotFoundException('No landmark kind found.');
        }

        return $this->render(
            'LandmarxLandmarkBundle:Kind:show.html.twig',
            array('kind' => $kind)
        );
    }

    public function newAction(Request $request)
    {
        $kind = new Kind();
        $form = $this->createForm(new KindType(), $kind);

        if ('POST' == $request->getMethod()) {
            $form->bindRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($kind);
                $em->flush();

                return $this->render(
                    'LandmarxLandmarkBundle:Kind:show.html.twig',
                    array('kind' => $kind)
                );
            }
        }

        return $this->render(
            'LandmarxLandmarkBundle:Kind:new.html.twig',
            array('form' => $form->createView())
        );
    }
}
