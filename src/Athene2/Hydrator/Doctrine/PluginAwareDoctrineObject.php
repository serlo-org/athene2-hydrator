<?php

namespace Athene2\Hydrator\Doctrine;

use Athene2\Hydrator\Plugin\HydratorPluginManager;
use Athene2\Hydrator\PluginAwareHydratorInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Athene2\Hydrator\PluginAwareHydratorTrait;

/**
 * Class HydratorPluginAwareDoctrineObject
 *
 * @package Athene2\Hydrator
 * @author  Aeneas Rekkas
 */
class PluginAwareDoctrineObject extends DoctrineObject implements PluginAwareHydratorInterface
{
    use PluginAwareHydratorTrait;

    /**
     * @var HydratorPluginManager
     */
    protected $pluginManager;

    /**
     * {@inheritDoc}
     */
    public function __construct(
        ObjectManager $objectManager,
        HydratorPluginManager $pluginManager,
        $byValue = true
    ) {
        parent::__construct($objectManager, $byValue);
        $this->pluginManager = $pluginManager;
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate(array $data, $object)
    {
        $this->prepare($object);
        $data = $this->hydrateViaPlugins($data, $object);
        return parent::hydrate($data, $object);
    }

    /**
     * {@inheritDoc}
     */
    public function extract($object)
    {
        return array_merge(parent::extract($object), $this->extractFromPlugins($object));
    }

    /**
     * {@inheritDoc}
     */
    public function getPluginManager()
    {
        return $this->pluginManager;
    }
}
