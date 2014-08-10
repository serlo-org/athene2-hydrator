<?php

namespace Athene2\Hydrator;

use Athene2\Hydrator\Plugin\HydratorPluginInterface;
use Athene2\Hydrator\Plugin\HydratorPluginManager;

/**
 * Class PluginAwareHydratorTrait
 *
 * @package Athene2\Hydrator
 * @author  Aeneas Rekkas
 */
trait PluginAwareHydratorTrait
{
    /**
     * @var array
     */
    protected $plugins = [];

    /**
     * @return HydratorPluginManager
     */
    abstract public function getPluginManager();

    /**
     * {@inheritDoc}
     */
    public function addPlugin($plugin)
    {
        if (!in_array($plugin, $this->plugins)) {
            $this->plugins[] = $plugin;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addPlugins(array $plugins)
    {
        foreach ($plugins as $plugin) {
            $this->addPlugin($plugin);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function removePlugin($plugin)
    {
        $pos = array_search($plugin, $this->plugins);
        if (false !== $pos) {
            unset($this->plugins[$pos]);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function removePlugins(array $plugins)
    {
        foreach ($plugins as $plugin) {
            $this->removePlugin($plugin);
        }
    }

    /**
     * @return HydratorPluginInterface[]
     */
    public function getPlugins()
    {
        $plugins = [];

        foreach ($this->plugins as $plugin) {
            $plugins[] = $this->getPluginManager()->get($plugin);
        }

        return $plugins;
    }

    /**
     * @param mixed $object
     * @return array
     */
    protected function extractFromPlugins($object)
    {
        $plugins = $this->getPlugins();
        $data    = [];

        foreach ($plugins as $plugin) {
            $data = array_merge($data, $plugin->extract($object));
        }

        return $data;
    }

    /**
     * @param array $data
     * @param mixed $object
     * @return array
     */
    protected function hydrateViaPlugins(array $data, $object)
    {
        $plugins = $this->getPlugins();

        foreach ($plugins as $plugin) {
            $data = $plugin->hydrate($data, $object);
        }

        return $data;
    }
}
