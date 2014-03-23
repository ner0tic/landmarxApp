<?php
namespace Landmarx\UtilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;
use Doctrine\Common\Collections\ArrayCollection;

use GeoPoint\Api\GeoPointApi as GP;

class UtilityController extends Controller implements ContainerAwareInterface
{
    /**
     * configuration settings
     * @var ArrayCollection
     */
    private $configs;

    /**
     * config file locator
     * @var FileLocater
     */
    private $locator;

    /**
     * container
     * @var type
     */
    protected $container;

    /**
     * security context
     * @var SecurityContext
     */
    protected $securityContext;

    /**
     * geo point library
     * @var GeoPointApi
     */
    protected $geo;

    /**
     * ip address information
     * @var array
     */
    protected $ipinfo;

    /**
     * set container
     * @param type $container|null container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;

        $this->securityContext = $this->container->get('security.context');
    }

    /**
     * __construct
     */
    public function __construct()
    {
        $base = DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config';
        $configDirectories = array(
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . 'config', 
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config'
        );
        $this->locator = new FileLocator($configDirectories);

        $this->geo = new GP();
        $this->geo->getClient()
             ->setApiKey(
                 $this->getParameter('geo_key')
             )
             ->setSecret(
                 $this->getParameter('geo_secret')
             );

        $ip = $_SERVER['REMOTE_ADDR'];

        if (in_array($ip, array('127.0.0.1', '10.10.0.1', '10.0.0.1'))) {
            $ip = '74.7.133.89';
        }

        $this->ipinfo = $this->geo->get($ip);
    }

    public function getParameter($parameter)
    {
        if (!$this->configs instanceof ArrayCollection)
        {
            $this->generateConfigs($file = 'parameters.yml', null, false);
        }

        return $this->configs->get($parameter);
    }

    private function generateConfigs($file, $path = null, $retFile = false)
    {
        $configs = Yaml::parse($this->locator->locate($file, $path, $retFile)[0]);

        $this->configs = new ArrayCollection($configs['parameters']);
    }
}
