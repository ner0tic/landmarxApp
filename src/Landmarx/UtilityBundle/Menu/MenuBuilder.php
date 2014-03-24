<?php
namespace Landmarx\UtilityBundle\Menu;

use Symfony\Component\HttpFoundation\Request;

use Landmarx\UtilityBundle\Menu\BaseBuilder;

class MenuBuilder extends BaseBuilder
{
    /**
     * Profile Menu
     * @param  Request $request request
     * @return MenuItem menu
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

    /**
     * Landmark menu
     * @param  boolean $include_submenus include submenus
     * @return MenuItem menu
     */
    public function landmarkMenu($include_submenus = true)
    {
        $menu = $this->factory->createItem('landmarks')
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', ' fa-thumb-tack');

        $menu->addChild(
            'list landmarks',
            array('route' => 'landmarx_landmark_index')
        );

        $menu->addChild(
            'find a landmark',
            array('route'   =>  'landmarx_landmark_search')
        );
    
        $menu->addChild(
            'add a landmark',
            array('route'         =>  'landmarx_landmark_new')
        );

        if ($include_submenus) {
            $menu->addChild($this->categoryMenu(!$include_submenus));
            $menu->addChild($this->landmarkTypeMenu(!$include_submenus));
        }

        return $menu;
    }

    public function categoryMenu($is_submenu = false)
    {
        $menu = $this->factory->createItem('landmark categories')
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'fa-list');

        $menu->addChild(
            'list landmark categories',
            array('route' => 'landmarx_category_index')
        );

        $menu->addChild(
            'add a category',
            array('route'         =>  'landmarx_category_new')
        );

        return $menu;
    }

    public function landmarkTypeMenu($is_submenu = false)
    {
        $menu = $this->factory->createItem('landmark types')
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'fa-tags');

        $menu->addChild(
            'list landmark types',
            array('route' => 'landmarx_type_index')
        );

        $menu->addChild(
            'add a landmark type',
            array('route'         =>  'landmarx_type_new')
        );

        return $menu;
    }

    public function collectionMenu()
    {
       $menu = $this->factory->createItem('collections')
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'fa-list-alt');

        $menu->addChild(
            'my collections',
            array('route'   =>  'landmarx_collection_index_by_user')
        );

        $menu->addChild(
            'search',
            array('route'   =>  'landmarx_collection_search')
        );

        $menu->addChild(
            'create a collection',
            array('route'   =>  'landmarx_collection_new')
        );
    }

    /**
     * create main menu
     * @param  Request $request [description]
     * @return MenuItem menu]
     */
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
        $menu->addChild($this->landmarkMenu());
        
        /**
        * Collections Menu
        **/
        $menu->addChild($this->collectionMenu());
        
        /** 
         * Auth / ProfileMmenu
         **/
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
