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

use Landmarx\CollectionBundle\Document\Type;
use Landmarx\CollectionBundle\Form\Type\TypeType;

class TypeController extends Controller
{
    /**
     * @Route("/", name="landmarx_type_index")
     * @Template("LandmarxCollectionBundle:Type:index.html.twig")
     */
    public function indexAction()
    {
        $types = $this->get('doctrine_mongodb')
                                ->getManager()
                                ->getRepository('LandmarxCollectionBundle:Type')
                                ->findAllOrderedByName();

        if (!$types) {
            throw $this->createNotFoundException('No types found.');
        }

        return $this->render('LandmarxCollectionBundle:Type:index.html.twig', array('types' => $types));
    }

    /**
     * @Route("/{slug}", name="landmarx_type_show")
     * @Template("LandmarxCollectionBundle:Type:show.html.twig")
     */
    public function showAction($slug)
    {
        $type = $this->getDoctrine()
                       ->getRepository('LandmarxCollectionBundle:Type')
                       ->findBySlug($slug);

        if (!$type) {
            throw $this->createNotFoundException('No collection type found.');
        }

        return $this->render('LandmarxCollectionBundle:Type:show.html.twig', array('type' => $type));
    }

    /**
     * @Route("/new", name="landmarx_type_new")
     * @Template("LandmarxCollectionBundle:Type:new.html.twig")
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
                    'LandmarxCollectionBundle:Type:show.html.twig',
                    array('type' => $type)
                );
            }
        }

        return $this->render(
            'LandmarxCollectionBundle:Type:new.html.twig',
            array('form' => $form->createView())
        );
    }
}
