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
use Landmarx\LandmarkBundle\Document\Category;
use Landmarx\LandmarkBundle\Form\Type\CategoryType;

class CategoryController extends Controller
{
    /**
     * @Route("/", name="landmarx_category_index")
     * @Template("LandmarxLandmarkBundle:Category:index.html.twig")
     */
    public function indexAction()
    {
        $query = $this->get('doctrine_mongodb')
                                ->getRepository('LandmarxLandmarkBundle:Category')
                                ->createQueryBuilder('c')
                                ->OrderedBy('c.name', 'ASC');
        
        $pager = new Pagerfanta(new DoctrineODMMongoDBAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 10));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
            'categories' => $pager->getCurrentPageResults(),
            'pager' => $pager
        );
    }

    /**
     * @Route("/{slug}", name="landmarx_category_show")
     * @Template("LandmarxLandmarkBundle:Category:show.html.twig")
     */
    public function showAction($slug)
    {
        $category = $this->get('doctrine_mongodb')
                         ->getRepository('LandmarxLandmarkBundle:Category')
                         ->findOneBySlug($slug);

        if (!$category) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'no matching category found.'
            );
            $this->redirect($this->generateUrl('landmarx_category_index'));
        }

        return array('category' => $category);
    }

    /**
     * @Route("/new", name="landmarx_category_new")
     * @Template("LandmarxLandmarkBundle:Category:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(new CategoryType(), $category);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $dm = $this->get('doctrine_mongOdb')->getManager();
                $dm->persist($category);
                $dm->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'category added.'
                );

                return $this->render(
                    'LandmarxLandmarkBundle:Category:show.html.twig',
                    array('category' => $category)
                );
            }

            return array('form' => $form->createView());
        }
    }
}
