<?php

namespace Athene2\Hydrator;

/**
 * Interface PluginAwareHydratorInterface
 *
 * @package Athene2\Hydrator
 * @author  Aeneas Rekkas
 */
interface PluginAwareHydratorInterface
{
    /**
     * Adds a plugin
     *
     * @param string $plugin
     * @return void
     */
    public function addPlugin($plugin);

    /**
     * Adds multiple plugins
     *
     * @param array $plugins
     * @return void
     */
    public function addPlugins(array $plugins);

    /**
     * Removes a plugin
     *
     * @param string $plugin
     * @return void
     */
    public function removePlugin($plugin);

    /**
     * Removes multiple plugins
     *
     * @param array $plugins
     * @return void
     */
    public function removePlugins(array $plugins);
}
