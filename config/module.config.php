<?php

namespace Athene2\Versioning;

/**
 * @author Aeneas Rekkas
 */
return [
    'service_manager'  => [
        'factories' => [
            __NAMESPACE__ . '\Hydrator\Plugin\HydratorPluginManager' => __NAMESPACE__ . '\Factory\HydratorPluginManagerFactory'
        ]
    ],
    'hydrator_plugins' => []
];
