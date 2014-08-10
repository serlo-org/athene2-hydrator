<?php

namespace Athene2Test\HydratorTest;

use Athene2\Hydrator\Plugin\HydratorPluginManager;
use Athene2Test\HydratorTest\Asset\PluginAwareHydratorImpl;

class PluginAwareHydratorTraitTest extends \PHPUnit_Framework_TestCase
{

    protected $pluginManager;

    public function setUp()
    {
        $this->pluginManager = new HydratorPluginManager();
        $this->pluginManager->setService('foo', $this->getMock('Athene2\Hydrator\Plugin\HydratorPluginInterface'));
        $this->pluginManager->setService('bar', $this->getMock('Athene2\Hydrator\Plugin\HydratorPluginInterface'));
    }

    public function testAddPlugin()
    {
        $hydrator = new PluginAwareHydratorImpl($this->pluginManager);
        $hydrator->addPlugin('foo');
        $this->assertInstanceOf('Athene2\Hydrator\Plugin\HydratorPluginInterface', current($hydrator->getPlugins()));
    }

    public function testAddPlugins()
    {
        $hydrator = new PluginAwareHydratorImpl($this->pluginManager);
        $hydrator->addPlugins(['foo', 'bar']);
        $this->assertInstanceOf('Athene2\Hydrator\Plugin\HydratorPluginInterface', current($hydrator->getPlugins()));
        $this->assertSame(2, count($hydrator->getPlugins()));
    }

    public function testRemovePlugin()
    {
        $hydrator = new PluginAwareHydratorImpl($this->pluginManager);
        $hydrator->addPlugins(['foo', 'bar']);
        $hydrator->removePlugin('foo');
        $this->assertInstanceOf('Athene2\Hydrator\Plugin\HydratorPluginInterface', current($hydrator->getPlugins()));
        $this->assertSame(1, count($hydrator->getPlugins()));
    }

    public function testRemovePlugins()
    {
        $hydrator = new PluginAwareHydratorImpl($this->pluginManager);
        $hydrator->addPlugins(['foo', 'bar']);
        $hydrator->removePlugins(['foo', 'bar']);
        $this->assertEmpty($hydrator->getPlugins());
    }
}
