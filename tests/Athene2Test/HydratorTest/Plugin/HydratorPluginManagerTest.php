<?php

namespace Athene2Test\HydratorTest\Plugin;

use Athene2\Hydrator\Plugin\HydratorPluginManager;

class HydratorPluginManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testValidatePlugin()
    {
        $pluginManager = new HydratorPluginManager();
        $mock          = $this->getMock('Athene2\Hydrator\Plugin\HydratorPluginInterface');

        $pluginManager->validatePlugin($mock);
    }

    public function testValidatePluginThrowsException()
    {
        $pluginManager = new HydratorPluginManager();

        $this->setExpectedException('Zend\ServiceManager\Exception\RuntimeException');
        $pluginManager->validatePlugin($this);
    }
}
