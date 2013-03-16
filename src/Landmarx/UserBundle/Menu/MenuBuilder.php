<?php
namespace Landmarx\UserBundle\Menu;

use Knp\Menu\FactoryInterface,
    Symfony\Component\DependencyInjection\ContainerAwareInterface,
    Symfony\Component\DependencyInjection\ContainerInterface,
    Symfony\Component\HttpFoundation\Request;

class MenuBuilder implements ContainerAwareInterface
{
    public function __construct( FactoryInterface $factory, ContainerInterface $container = null )
    {
        $this->factory = $factory;
        $this->container = $container;
    }
    
    public function setContainer( ContainerInterface $container = null )
    {
        $this->container = $container;
    }

    public function createMainMenu( Request $request, $container = null )
    {
        $this->setContainer( $container );
        //$this->user = $this->container->get(' security.context' )->getToken()->getUser();
        
        $menu = $this->factory->createItem( 'root' );
        
        $menu->addChild(
                'home',
                array(
                    'uri'   =>  'homepage'
        ) );
        
        /***********************************************************************
         * landmark Submenu
         **********************************************************************/
        $menu->addChild(
                'landmarks',
                array(
                    'uri'   =>  'landmarks'
        ) );
        
        $menu[ 'landmarks' ]->addChild(
                'find A landmark',
                array(
                    'uri'   =>  'landmark_search'
        ) );
        
        $menu[ 'landmarks' ]->addChild(
                'add a landmark',
                array(
                    'uri'   =>  'landmark_new'
        ) );
        
        /***********************************************************************
         * Landmark Category Submenu
         **********************************************************************/
        $menu[ 'landmarks' ]->addChild(
                'landmark categories',
                array(
                    'uri'   =>  'landmark_categories'
        ) );
        
        $menu[ 'landmarks' ][ 'landmark categories' ]->addChild(
                'add A category',
                array(
                    'uri'   =>  'landmark_category_new'
        ) );
        
        /***********************************************************************
         * Landmark Kind Submenu
         **********************************************************************/
        $menu[ 'landmarks' ]->addChild(
                'landmark kinds',
                array(
                    'uri'   =>  'landmark_kinds'
        ) );
        
        $menu[ 'landmarks' ][ 'landmark kinds' ]->addChild(
                'add a kind',
                array(
                    'uri'   =>  'landmark_kind_new'
        ) );
        
        
        /***********************************************************************
         * Auth Menuitems
         **********************************************************************/
        if( 1==2 )//$user->isGranted( "IS_AUTHENTICATED_REMEMBERED" ) )
        {
            $menu->addChild(
                    'signout',
                    array(
                        'uri'   =>  'fos_user_security_logout'
            ) );
        }
        else
        {
            
            $menu->addChild(
                    'signup',
                    array(
                        'uri'   =>  'fos_user_security_register'
            ) );
            
            $menu->addChild(
                    'signin',
                    array(
                        'uri'   =>  'fos_user_security_login'
            ) );
        }
        
        return $menu;
        
    }
}