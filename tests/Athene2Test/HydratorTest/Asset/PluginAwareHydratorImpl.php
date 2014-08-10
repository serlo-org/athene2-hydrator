<?php

namespace Athene2Test\HydratorTest\Asset;

use Athene2\Hydrator\Plugin\HydratorPluginManager;
use Athene2\Hydrator\PluginAwareHydratorTrait;

class PluginAwareHydratorImpl
{
    use PluginAwareHydratorTrait;

    /**
     * @var HydratorPluginManager
     */
    protected $pluginManager;

    /**
     * @param HydratorPluginManager $pluginManager
     */
    public function __construct(HydratorPluginManager $pluginManager)
    {
        $this->pluginManager = $pluginManager;
    }

    /**
     * @return HydratorPluginManager
     */
    public function getPluginManager()
    {
        return $this->pluginManager;
    }
}
