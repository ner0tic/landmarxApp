<?php
namespace Landmarx\UtilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

use GeoPoint\Api\GeoPointApi as GP;

class UtilityController extends Controller implements ControllerAwareInterface
{
    protected $config;

    protected $container;

    protected $securityContext;

    protected $geo;

    protected $ipinfo;

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;

        $this->securityContext = $this->container->get('security.context');
    }

    public function __construct()
    {
        $this->geo = new GP();
        $this->geo->getClient()
             ->setApiKey(
                 $this->container->getParameter('geo_key')
             )
             ->setSecret(
                 $this->container->getParameter('geo_secret')
             );

        $ip = $_SERVER['REMOTE_ADDR'];

        if (in_array($ip, array('127.0.0.1', '10.10.0.1'))) {
            $ip = '74.7.133.89';
        }

        $this->ipinfo = $this->geo->get($ip);
    }
}
