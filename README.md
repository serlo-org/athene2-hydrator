athene2-hydrator
================

[![Build Status](https://travis-ci.org/serlo-org/athene2-hydrator.svg)](https://travis-ci.org/serlo-org/athene2-hydrator)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/serlo-org/athene2-hydrator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/serlo-org/athene2-hydrator/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/serlo-org/athene2-hydrator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/serlo-org/athene2-hydrator/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/serlo-org/athene2-hydrator/badges/build.png?b=master)](https://scrutinizer-ci.com/g/serlo-org/athene2-hydrator/build-status/master)

**Attention, this module is not fully tested yet**

## Installation

athene2-versioning only officially supports installation through Composer. For Composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

Install the module:

```sh
$ php composer.phar require serlo-org/athene2-hydrator:dev-master
```

## Hydrators?

This Zend Framework 2 module aims to provide you with advanced PluginAware Hydrators for Hydrators bundled with
ZF2 and the Doctrine Module. The following Hydrators have been modified for Plugin use:

* [DoctrineObject](https://github.com/doctrine/DoctrineModule/blob/master/docs/hydrator.md)
* `ArraySerializable`
* `ClassMethods`
* `ObjectProperty`
* `Reflection`

## Plugins?

Object hydration can - sometimes - become difficult. Some hydration steps may need advanced logic.
Let's take a real world example:

Bob updates the artists name of a music track entry on a web page. The new artist name is not in the database and
needs to be created first and then associated with the track entry. A plugin could do this easily:

```php
public function hydrate(array $data, $object)
{
    $data['artist'] = $this->myArtistService->createIfNotExists($data['artist']);
    return $data;
}
```

## Usage

To create a new plugin, just implement `Athene2\Hydrator\Plugin\HydratorPluginInterface`. To add that plugin to the
HydratorPluginManager, add the following to your *module.config.php*:

```php
return [
    'hydrator_plugins' => [
        'invokables' => [
            'myPlugin' => 'MyNamespace\Hydrator\Plugin\MyPlugin'
        ]
    ]
];
```

The HydratorPluginManager is a ZF2 PluginManager, so you can use the `factory` and `alias` key as well.

Now let's create a Hydrator!

```php
$pluginManager = $serviceManager->get('Athene2\Hydrator\Plugin\HydratorPluginManager');
$hydrator      = new PluginAwareClassMethods($pluginManager);

// Let's add the plugin 'myPlugin' to this hydrator
$hydrator->addPlugin('myPlugin');

// The plugin will be called before hydration takes place.
// What you do in the plugin does not matter. You can inject stuff or just modify the hydration data.
// Be aware however, that every key value pair you return will be hydrated by the ClassMethod hydrator.
// Make sure to remove key value pairs, which should be ignored by ClassMethod (or any other hydrator for that matter).
$hydrator->hydrate($myObject, $myData);

// The plugin will be called after extraction takes place.
$data = $hydrator->extract($myObject);
```