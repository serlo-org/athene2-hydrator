<?php

namespace Athene2\Hydrator\Plugin;

use Athene2\Hydrator\Exception\PluginException;

/**
 * Interface HydratorPluginInterface
 *
 * @package Athene2\Hydrator\Plugin
 * @author  Aeneas Rekkas
 */
interface HydratorPluginInterface
{
    /**
     * Extracts (key, value) pairs from the object for merging with the overall extract result.
     *
     * @param object $object
     * @return array
     * @throws PluginException
     */
    public function extract($object);

    /**
     * (Partially) hydrates the object and removes the affected (key, value) pairs from the return set.
     *
     * @param array $data
     * @param mixed $object
     * @return array
     * @throws PluginException
     */
    public function hydrate(array $data, $object);
}
