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
use Landmarx\LandmarkBundle\Document\Category;
use Landmarx\LandmarkBundle\Form\Type\CategoryType;

class CategoryController extends Controller
{
    /**
     *
     * @return render
     * @throws NotFoundException
     */
    public function indexAction()
    {
        $categories = $this;

        if (!$categories) {
            throw $this->createNotFoundException('No categories found.');
        }

        return $this->render('LandmarxLandmarkBundle:Category:index.html.twig', array('categories' => $categories));
    }

    /**
     *
     * @param string $slug
     * @return return
     * @throws NotFoundException
     */
    public function showAction($slug)
    {
        $category = $this->getDoctrine()
                       ->getRepository('LandmarxLandmarkBundle:Category')
                       ->findBySlug($slug);

        if (!$category) {
            throw $this->createNotFoundException('No landmark category found.');
        }

        return $this->render('LandmarxLandmarkBundle:Category:show.html.twig', array('category' => $category));
    }

    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(new CategoryType(), $category);

        if ('POST' == $request->getMethod()) {
            $form->bindRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($category);
                $em->flush();

                return $this->render(
                    'LandmarxLandmarkBundle:Category:show.html.twig',
                    array('category' => $category)
                );
            }
        }

        return $this->render(
            'LandmarxLandmarkBundle:Category:new.html.twig',
            array('form' => $form->createView())
        );
    }
}
