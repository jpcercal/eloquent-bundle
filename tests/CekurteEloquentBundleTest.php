<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\EloquentBundle\Tests;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class CekurteEloquentBundleTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 1.0
 */
class CekurteEloquentBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritedOfBundle()
    {
        $reflection = new \ReflectionClass('\\Cekurte\\EloquentBundle\\CekurteEloquentBundle');

        $this->assertTrue($reflection->isSubclassOf(
            '\\Symfony\\Component\\HttpKernel\\Bundle\\Bundle'
        ));
    }
}
