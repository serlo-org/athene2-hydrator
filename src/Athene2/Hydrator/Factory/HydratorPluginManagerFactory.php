<?php

namespace Athene2\Hydrator\Factory;

use Athene2\Hydrator\Plugin\HydratorPluginManager;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class HydratorPluginManagerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config   = $serviceLocator->get('config');
        $config   = isset($config['hydrator_plugins']) ? $config['hydrator_plugins'] : [];
        $config   = new Config($config);
        $hydrator = new HydratorPluginManager($config);
        return $hydrator;
    }
}
