<?php
namespace Landmarx\LandmarkBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineODMMongoDBAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

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
        $query = $this->get('doctrine_mongodb')
                                ->getRepository('LandmarxLandmarkBundle:Type')
                                ->createQueryBuilder('t')
                                ->OrderedBy('t.name', 'ASC');
        
        $pager = new Pagerfanta(new DoctrineODMMongoDBAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 10));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
            'types' => $pager->getCurrentPageResults(),
            'pager' => $pager
        );
    }

    /**
     * @Route("/{slug}", name="landmarx_type_show")
     * @Template("LandmarxLandmarkBundle:Type:show.html.twig")
     */
    public function showAction($slug)
    {
        $type = $this->get('doctrine_mongodb')
                         ->getRepository('LandmarxLandmarkBundle:Type')
                         ->findOneBySlug($slug);

        if (!$type) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'no matching type found.'
            );
            $this->redirect($this->generateUrl('landmarx_type_index'));
        }

        return array('type' => $type);
    }

    /**
     * @Route("/new", name="landmarx_type_show")
     * @Template("LandmarxLandmarkBundle:Type:show.html.twig")
     */
    public function newAction(Request $request)
    {
        $type = new Type();
        $form = $this->createForm(new TypeType(), $type);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $dm = $this->get('doctrine_mongOdb')->getManager();
                $dm->persist($type);
                $dm->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'type added.'
                );

                return $this->render(
                    'LandmarxLandmarkBundle:Type:show.html.twig',
                    array('type' => $type)
                );
            }

            return array('form' => $form->createView());
        }
    }
}
