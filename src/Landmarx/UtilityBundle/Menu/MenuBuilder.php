<?php
namespace Landmarx\UtilityBundle\Menu;

use Symfony\Component\HttpFoundation\Request;

use Landmarx\UtilityBundle\Menu\BaseBuilder;

class MenuBuilder extends BaseBuilder
{
    /**
     * @param Request $request request
     * @return MenuItem 
     */
    public function profileMenu(Request $request)
    {
        $menu = $this->factory->createItem($this->securityContext->getUser()->getName())
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'icon-user');

        $menu->addChild(
            'view profile',
            array(
                'route' => 'fos_user_profile_show',
                'routeParameters' => array(
                    'slug' => $this->securityContext->getSlug()
                )
            )
        );

        $menu->addChild(
            'edit profile',
            array(
                'route' => 'fos_user_profile_edit',
                'routeParameters' => array(
                    'slug' => $this->securityContext->getSlug()
                )
            )
        );

        $menu->addChild(
            'change password',
            array('route' => 'fos_user_change_password')
        );

        $menu->addChild(
            'sign out',
            array('route' => 'fos_user_security_logout')
        );
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav pull-right');

        $menu->addChild(
            'home',
            array('route'   =>  'homepage')
        );

        /**
        * Landmarks Menu
        **/
        $menu->addChild('landmarks')
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'icon-user');
        $menu[ 'landmarks' ]->addChild(
            'find a landmark',
            array('route'   =>  'landmarx_landmark_search')
        );
    
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

        /**
        * Landmarks :: Categories Submenu
        **/
        $menu[ 'landmarks' ]->addChild(
            'landmark categories',
            array('route'   =>  'landmarx_category')
        );
        $menu[ 'landmarks' ][ 'landmark categories' ]->addChild(
            'add a category',
            array('route'   =>  'landmarx_category_new')
        );

        /**
        * Landmarks :: Type Submenu
        **/
        $menu[ 'landmarks' ]->addChild(
            'landmark types',
            array('route'   =>  'landmarx_type_index')
        );
        if ($this->securityContext->isGranted('USER_ADMIN')) {
            $menu[ 'landmarks' ][ 'landmark types' ]->addChild(
                'add a type',
                array('route'   =>  'landmarx_type_new')
            );
        }

        /**
        * Collections Menu
        **/
        $menu->addChild(
            'collections',
            array('route'   =>  'landmarx_collection_index')
        )
        ->setAttribute('dropdown', true)
        ->setAttribute('icon', 'icon-user');
        $menu[ 'collections' ]->addChild(
            'my collections',
            array('route'   =>  'landmarx_collections_index_by_user')
        );
        $menu[ 'collections' ]->addChild(
            'search',
            array('route'   =>  'landmarx_collection_search')
        );
        $menu[ 'collections' ]->addChild(
            'create',
            array('route'   =>  'landmarx_collection_new')
        );
        
        if ($this->securityContext->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')) {
            $menu->addChild(
                'signup',
                array(
                    // 'route'   =>  'fos_user_registration_register'
                    'uri'   =>  '#auth-modal',
                    'linkAttributes'    =>  array(
                        'role'          =>  'button',
                        'class'         =>  'btn',
                        'data-toggle'   =>  'modal',
                        'data-remote'   => "path('fos_user_registration_register')"
                    )
                )
            );
            $menu->addChild(
                'signin',
                array(
                    // 'route'   =>  'fos_user_security_login'
                    'uri'   =>  '#auth-modal',
                    'linkAttributes'    =>  array(
                        'role'          =>  'button',
                        'class'         =>  'btn',
                        'data-toggle'   =>  'modal',
                        'data-remote'   => "path('fos_user_registration_register')"
                    )
                )
            );
        } else {
            $menu->addChild($this->profileMenu());
        }

        return $menu;
    }
}
