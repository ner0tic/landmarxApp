<?php
namespace Landmarx\UserBundle\Handler;

use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AuthenticationHandler implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface
{
    /**
     * router
     * @var Router
     */
    protected $router;

    /**
     * security
     * @var SecurityContext
     */
    protected $security;

    /**
     * user manager
     * @var type
     */
    protected $userManager;

    /**
     * service container
     * @var type
     */
    protected $service_container;

    /**
     * construct description
     * @param RouterInterface $router            router
     * @param SecurityContext $security          security
     * @param type          $userManager       user manager
     * @param type          $service_container container
     */
    public function __construct(RouterInterface $router, SecurityContext $security, $userManager, $service_container)
    {
        $this->router = $router;
        $this->security = $security;
        $this->userManager = $userManager;
        $this->service_container = $service_container;

    }

    /**
     * onAuthenticationSuccess
     * @param  Request        $request request
     * @param  TokenInterface $token   token
     * @return Response|RedirectResponse           response
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if ($request->isXmlHttpRequest()) {
            $result = array('success' => true);
            $response = new Response(json_encode($result));
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        }
        else {
            $request->getSession()->getFlashBag()->set('error', $exception->getMessage());
            $url = $this->router->generate('fos_user_security_login');

            return new RedirectResponse($url);
        }

        return new RedirectResponse($this->router->generate('anag_new')); 
    } 

    /**
     * onAuthenticationFailure description
     * @param  Request                 $request   request
     * @param  AuthenticationException $exception exception
     * @return Response      response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {

        if ($request->isXmlHttpRequest()) {
            $result = array(
                'success' => false, 
                'error' => true,
                'function' => 'onAuthenticationFailure',
                'message' => $this->translator->trans(
                    $exception->getMessage(), 
                    array(), 
                    'FOSUserBundle'
                )
            );
            $response = new Response(json_encode($result));
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        }
        
        return new Response();
    }
}