<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\EloquentBundle\Tests\DependencyInjection;

use Cekurte\EloquentBundle\DependencyInjection\CekurteEloquentExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class CekurteEloquentExtensionTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 1.0
 */
class CekurteEloquentExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerBuilder
     */
    protected $configuration;

    public function setUp()
    {
        $this->configuration = new ContainerBuilder();

        $loader = new CekurteEloquentExtension();

        $configs = array(
            'cekurte_eloquent'  => array(
                'connection'    => array(
                    'host'      => 'fake-host.tld',
                    'database'  => 'fake-database-name',
                    'username'  => 'fake-user',
                ),
            ),
        );

        $loader->load($configs, $this->configuration);
    }

    public function testParametersOfConnection()
    {
        $parametersOfConnection = array(
            'driver'    => 'mysql',
            'host'      => 'fake-host.tld',
            'database'  => 'fake-database-name',
            'username'  => 'fake-user',
            'password'  => '',
            'collation' => 'utf8_unicode_ci',
            'charset'   => 'utf8',
            'prefix'    => '',
        );

        $allParametersOfConnection = array();

        foreach ($parametersOfConnection as $key => $value) {
            $allParametersOfConnection[$key] = sprintf('%%cekurte_eloquent.connection.%s%%', $key);

            $this->assertEquals(
                $this->configuration->getParameterBag()->get(sprintf('cekurte_eloquent.connection.%s', $key)),
                $value
            );
        }

        $this->assertEquals(
            $this->configuration->getParameterBag()->get('cekurte_eloquent.connection'),
            $allParametersOfConnection
        );
    }

    public function testParameterBootSubscriber()
    {
        $this->assertEquals(
            $this->configuration->getParameterBag()->get('cekurte_eloquent.event_listener.boot_subscriber.class'),
            'Cekurte\EloquentBundle\EventListener\BootSubscriber'
        );
    }

    public function testParameterCapsule()
    {
        $this->assertEquals(
            $this->configuration->getParameterBag()->get('cekurte_eloquent.capsule.class'),
            'Illuminate\Database\Capsule\Manager'
        );
    }

    public function testServiceCapsule()
    {
        $definition = $this->configuration->getDefinition('cekurte_eloquent.capsule');

        $this->assertEquals('%cekurte_eloquent.capsule.class%', $definition->getClass());

        $this->assertTrue($definition->hasMethodCall('addConnection'));

        $methodCalls = $definition->getMethodCalls();

        /** @var Reference $reference */
        $reference = $methodCalls[0][1][0];

        $this->assertEquals('%cekurte_eloquent.connection%', (string) $reference);
    }

    public function testServiceBootSubscriber()
    {
        $definition = $this->configuration->getDefinition('cekurte_eloquent.event_listener.boot_subscriber');

        $this->assertEquals('%cekurte_eloquent.event_listener.boot_subscriber.class%', $definition->getClass());

        $this->assertTrue($definition->hasTag('kernel.event_subscriber'));

        $arguments = $definition->getArguments();

        /** @var Reference $reference */
        $reference = $arguments[0];

        $this->assertEquals('cekurte_eloquent.capsule', (string) $reference);
    }
}
