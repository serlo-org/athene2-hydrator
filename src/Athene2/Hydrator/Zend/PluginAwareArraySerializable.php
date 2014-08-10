<?php

namespace Athene2\Hydrator\Zend;

use Athene2\Hydrator\Plugin\HydratorPluginManager;
use Athene2\Hydrator\PluginAwareHydratorTrait;
use Zend\Stdlib\Hydrator\ArraySerializable;
use Athene2\Hydrator\Exception\PluginException;

/**
 * Class PluginAwareObjectProperty
 *
 * @package Athene2\Hydrator\Zend
 * @author  Aeneas Rekkas
 */
class PluginAwareArraySerializable extends ArraySerializable
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
        parent::__construct();
        $this->pluginManager = $pluginManager;
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate(array $data, $object)
    {
        $data = $this->hydrateViaPlugins($data, $object);
        return parent::hydrate($data, $object);
    }

    /**
     * {@inheritDoc}
     * @throws PluginException
     */
    public function extract($object)
    {
        return array_merge(parent::extract($object), $this->extractFromPlugins($object));
    }

    /**
     * {@inheritDoc}
     * @throws PluginException
     */
    public function getPluginManager()
    {
        return $this->pluginManager;
    }
}
