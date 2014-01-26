<?php
namespace Landmarx\CollectionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

use Landmarx\CollectionBundle\Document\Collection;
use Landmarx\CollectionBundle\Form\Type\CollectionType;

class CollectionController extends Controller
{
    /**
     * @Route("/", name="landmarx_collection_index")
     * @Template("LandmarxCollectionBundle:Collection:index.html.twig")
     */
    public function indexAction()
    {
        $collections = $this->get('doctrine_mongodb')
                                ->getManager()
                                ->getRepository('LandmarxCollectionBundle:Collection')
                                ->findAllOrderedByName();

        if (!$collections) {
            throw $this->createNotFoundException('No collections found.');
        }

        return $this->render(
            'LandmarxCollectionBundle:Collection:index.html.twig',
            array(
                'collections' => $collections
          )
        );
    }

    /**
     * @Route("/{slug}", name="landmarx_collection_show")
     * @Template("LandmarxCollectionBundle:Collection:show.html.twig")
     */
    public function showAction($slug)
    {
        $collection = $this->get('doctrine_mongodb')
                         ->getManager()
                         ->getRepository('LandmarxCollectionBundle:Collection')
                         ->findBySlug($slug);

        if (!$collection) {
            throw $this->createNotFoundException('No collection found.');
        }

        return $this->render(
            'LandmarxCollectionBundle:Collection:show.html.twig',
            array('collection' => $collection)
        );
    }

    /**
     * @Route("/new", name="landmarx_collection_new")
     * @Template("LandmarxCollectionBundle:Collection:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $collection = new Collection();
        $form = $this->createForm(new CollectionType());

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $dm = $this->get('doctrine_mongodb')->getManager();
                $dm->persist($collection);
                $dm->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'collection added.'
                );

                return $this->render(
                    'LandmarxCollectionBundle:Collection:show.html.twig',
                    array('collection' => $collection)
                );
            }

            return array('form' => $form->createView());
        }
    }
}
