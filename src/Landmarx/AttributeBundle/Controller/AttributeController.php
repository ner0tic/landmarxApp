<?php

namespace Landmarx\AttributeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineODMMongoDBAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

use Landmarx\UtilityBundle\Controller\UtilityController as Controller;
use Landmarx\AttributeBundle\Document\Attribute;
use Landmarx\AttributeBundle\Form\Type\AttributeType;

class AttributeController extends Controller
{
   /**
     * @Route("/", name="landmarx_attribute_index")
     * @Template("LandmarxAttributeBundle:Attribute:index.html.twig")
     */
    public function indexAction()
    {
        $query = $this->get('doctrine_mongodb')
                                ->getRepository('LandmarxAttributeBundle:Attribute')
                                ->createQueryBuilder('a');
        
        $pager = new Pagerfanta(new DoctrineODMMongoDBAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 10));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
            'attributes' => $pager->getCurrentPageResults(),
            'pager' => $pager
        );
    }

    /**
     * @Route("/{slug}", name="landmarx_attribute_show")
     * @Template("LandmarxAttributeBundle:Attribute:show.html.twig")
     */
    public function showAction($slug)
    {
        $attribute = $this->get('doctrine_mongodb')
                         ->getRepository('LandmarxAttributeBundle:Attribute')
                         ->findOneBySlug($slug);

        if (!$attribute) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'no matching attribute found.'
            );
            $this->redirect($this->generateUrl('landmarx_attribute_index'));
        }

        return array('attribute' => $attribute);
    }

    /**
     * @Route("/new", name="landmarx_attribute_new")
     * @Template("LandmarxAttributeBundle:Attribute:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $attribute = new Attribute();
        $form = $this->createForm(new AttributeType(), $attribute);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $dm = $this->get('doctrine_mongOdb')->getManager();
                $dm->persist($attribute);
                $dm->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'attribute added.'
                );

                return $this->render(
                    'LandmarxAttributeBundle:Attribute:show.html.twig',
                    array('attribute' => $attribute)
                );
            }

            return array('form' => $form->createView());
        }
    }
}