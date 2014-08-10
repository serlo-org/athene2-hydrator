<?php

namespace Athene2Test\HydratorTest\Zend;

use Athene2\Hydrator\Zend\PluginAwareClassMethods;
use Athene2Test\HydratorTest\Asset\AbstractPluginAwareTest;
use Athene2Test\HydratorTest\Asset\EntityAsset;

class PluginAwareClassMethodsTest extends AbstractPluginAwareTest
{
    public function testHydrateCallsPlugin()
    {
        $pluginManager = $this->getPluginManager();
        $hydrator      = new PluginAwareClassMethods($pluginManager);
        $entity        = new EntityAsset();
        $plugin        = $this->addPlugin($pluginManager, 'foo');
        $data          = [];

        $plugin->expects($this->once())->method('hydrate')->with($data, $entity)->will($this->returnValue(['id' => 1]));
        $hydrator->addPlugin('foo');

        $hydrator->hydrate($data, $entity);
        $this->assertEquals(1, $entity->getId());
    }

    public function testExtractCallsPlugin()
    {
        $pluginManager = $this->getPluginManager();
        $hydrator      = new PluginAwareClassMethods($pluginManager);
        $entity        = new EntityAsset();
        $plugin        = $this->addPlugin($pluginManager, 'foo');

        $entity->setId(1);
        $hydrator->addPlugin('foo');

        $plugin->expects($this->once())->method('extract')->with($entity)->will($this->returnValue(['foo' => 'bar']));
        $this->assertEquals(['id' => 1, 'foo' => 'bar'], $hydrator->extract($entity));
    }
}
