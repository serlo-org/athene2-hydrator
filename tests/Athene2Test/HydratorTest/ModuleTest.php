<?php

namespace Athene2Test\HydratorTest;

use Athene2\Hydrator\Module;

/**
 * Class ModuleTest
 *
 * @package VersioningTest
 * @author  Aeneas Rekkas
 */
class ModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testConfigIsArray()
    {
        $module = new Module();
        $this->assertInternalType('array', $module->getConfig());
    }
}
