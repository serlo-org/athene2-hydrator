<?php

namespace Athene2\Hydrator\Plugin;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception;

/**
 * Class HydratorPluginManager
 *
 * @package Athene2\Hydrator\Plugin
 * @author Aeneas Rekkas
 */
class HydratorPluginManager extends AbstractPluginManager
{
    /**
     * {@inheritDoc}
     */
    public function validatePlugin($plugin)
    {
        if (!$plugin instanceof HydratorPluginInterface) {
            throw new Exception\RuntimeException(sprintf(
                'Expected %s but got %s',
                'HydratorPluginInterface',
                is_object($plugin) ? get_class($plugin) : gettype($plugin)
            ));
        }
    }
}
