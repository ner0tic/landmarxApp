<?php
namespace Landmarx\UtilityBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder implements ContainerAwareInterface
{
    public function __construct(FactoryInterface $factory, ContainerInterface $container = null)
    {
        $this->factory = $factory;
        $this->container = $container;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function createMainMenu(Request $request, $container = null)
    {
        $this->setContainer($container);
        //$this->user = $this->container->get(' security.context')->getToken()->getUser();

        $menu = $this->factory->createItem('root');

        $menu->addChild(
            'home',
            array('route'   =>  'homepage')
        );
        ////////////////////////////////////////////////////////////////////////
        // Landmarks ///////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $menu->addChild(
            'landmarks',
            array('route'   =>  'landmarks')
        )
        ->setAttribute('dropdown', true);
        ////////////////////////////////////////////////////////////////////////
        // Landmarks :: search /////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $menu[ 'landmarks' ]->addChild(
            'find a landmark',
            array('route'   =>  'landmarx_landmark_search')
        );
        ////////////////////////////////////////////////////////////////////////
        // Landmarks :: add ////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $menu[ 'landmarks' ]->addChild(
            'add a landmark',
            array('route'         =>  'landmarx_landmark_new')
        );
        $menu[ 'landmarks' ][ 'add a landmark' ]->setLinkAttributes(
            array(
                'data-target'   =>  '#auth-modal',
                'data-toggle'   =>  'modal'
            )
        );
        ////////////////////////////////////////////////////////////////////////
        // Landmarks :: Categories /////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $menu[ 'landmarks' ]->addChild(
            'landmark categories',
            array('route'   =>  'landmarx_category')
        );
        ////////////////////////////////////////////////////////////////////////
        // Landmarks :: Categories :: add //////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $menu[ 'landmarks' ][ 'landmark categories' ]->addChild(
            'add a category',
            array('route'   =>  'landmarx_category_new')
        );
        ////////////////////////////////////////////////////////////////////////
        // Landmarks :: Kind ///////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $menu[ 'landmarks' ]->addChild(
            'landmark kinds',
            array('route'   =>  'landmarx_kind_index')
        );
        ////////////////////////////////////////////////////////////////////////
        // Landmarks :: Kinds :: add ///////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $menu[ 'landmarks' ][ 'landmark kinds' ]->addChild(
            'add a kind',
            array('route'   =>  'landmarx_kind_new')
        );
        ////////////////////////////////////////////////////////////////////////
        // Collections /////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $menu->addChild(
            'collections',
            array('route'   =>  'landmarx_collection_index')
        )
        ->setAttribute('dropdown', true);
        ////////////////////////////////////////////////////////////////////////
        // Collections :: my ///////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $menu[ 'collections' ]->addChild(
            'my collections',
            array('route'   =>  'landmarx_collections_index_by_user')
        );
        ////////////////////////////////////////////////////////////////////////
        // Collections :: search ///////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $menu[ 'collections' ]->addChild(
            'search',
            array('route'   =>  'landmarx_collection_search')
        );
        ////////////////////////////////////////////////////////////////////////
        // Collections :: my ///////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $menu[ 'collections' ]->addChild(
            'create',
            array('route'   =>  'landmarx_collection_new')
        );
        ////////////////////////////////////////////////////////////////////////
        // Auth ////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        if (1==2) {//$user->isGranted("IS_AUTHENTICATED_REMEMBERED"))
            ////////////////////////////////////////////////////////////////////
            // Auth :: signout /////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $menu->addChild(
                'signout',
                array('route'   =>  'fos_user_security_logout')
            );
        } else {
            ////////////////////////////////////////////////////////////////////
            // Auth :: signup //////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////
            $menu->addChild(
                'signup',
                array(
                    // 'route'   =>  'fos_user_registration_register'
                    'uri'   =>  '#auth-modal',
                    'linkAttributes'    =>  array(
                        'role'          =>  'button',
                        'class'         =>  'btn',
                        'data-toggle'   =>  'modal',
                        'data-remote'   => $this->container
                            ->get('router')
                            ->generate(
                                'fos_user_registration_register',
                                array(),
                                true
                            )
                    )
                )
            );
            ////////////////////////////////////////////////////////////////////////
            // Auth :: signin //////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            $menu->addChild(
                'signin',
                array(
                    // 'route'   =>  'fos_user_security_login'
                    'uri'   =>  '#auth-modal',
                    'linkAttributes'    =>  array(
                        'role'          =>  'button',
                        'class'         =>  'btn',
                        'data-toggle'   =>  'modal',
                        'data-remote'   => $this->container
                            ->get('router')
                            ->generate(
                                'fos_user_security_login',
                                array(),
                                true
                            )
                    )
                )
            );
        }
        return $menu;
    }
}
