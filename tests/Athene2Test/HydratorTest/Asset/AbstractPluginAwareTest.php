<?php

namespace Athene2Test\HydratorTest\Asset;

use Athene2\Hydrator\Plugin\HydratorPluginManager;
use Athene2\Hydrator\Plugin\HydratorPluginInterface;

abstract class AbstractPluginAwareTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return HydratorPluginManager
     */
    protected function getPluginManager()
    {
        return new HydratorPluginManager();
    }

    /**
     * @param HydratorPluginManager $pluginManager
     * @param string                $name
     * @return \PHPUnit_Framework_MockObject_MockObject|HydratorPluginInterface
     */
    protected function addPlugin(HydratorPluginManager $pluginManager, $name)
    {
        $plugin = $this->getMock('Athene2\Hydrator\Plugin\HydratorPluginInterface');
        $pluginManager->setService($name, $plugin);
        return $plugin;

    }
}
 