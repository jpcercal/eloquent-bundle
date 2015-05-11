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

use Cekurte\EloquentBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Processor;

/**
 * Class ConfigurationTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 1.0
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testEmpty()
    {
        $processor = new Processor();

        $processedConfiguration = $processor->processConfiguration(new Configuration(true), array());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testEmptyWithRootNode()
    {
        $processor = new Processor();

        $processedConfiguration = $processor->processConfiguration(new Configuration(true), array(
            'cekurte_eloquent'  => array(),
        ));
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testEmptyWithRootNodeAndConnection()
    {
        $processor = new Processor();

        $processedConfiguration = $processor->processConfiguration(new Configuration(true), array(
            'cekurte_eloquent'  => array(
                'connection'    => array(),
            ),
        ));
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testMissingUsername()
    {
        $processor = new Processor();

        $processedConfiguration = $processor->processConfiguration(new Configuration(true), array(
            'cekurte_eloquent'  => array(
                'connection'    => array(
                    'host'      => 'fake-host.tld',
                    'database'  => 'fake-database-name',
                ),
            ),
        ));
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testMissingDatabase()
    {
        $processor = new Processor();

        $processedConfiguration = $processor->processConfiguration(new Configuration(true), array(
            'cekurte_eloquent'  => array(
                'connection'    => array(
                    'host'      => 'fake-host.tld',
                    'username'  => 'fake-user',
                ),
            ),
        ));
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testMissingHost()
    {
        $processor = new Processor();

        $processedConfiguration = $processor->processConfiguration(new Configuration(true), array(
            'cekurte_eloquent'  => array(
                'connection'    => array(
                    'database'  => 'fake-database-name',
                    'username'  => 'fake-user',
                ),
            ),
        ));
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testInvalidHost()
    {
        $processor = new Processor();

        $processedConfiguration = $processor->processConfiguration(new Configuration(true), array(
            'cekurte_eloquent'  => array(
                'connection'    => array(
                    'driver'    => 'pdo_mysql',
                ),
            ),
        ));
    }

    public function testValidHostMysql()
    {
        $processor = new Processor();

        $processedConfiguration = $processor->processConfiguration(new Configuration(true), array(
            'cekurte_eloquent'  => array(
                'connection'    => array(
                    'host'      => 'fake-host.tld',
                    'database'  => 'fake-database-name',
                    'username'  => 'fake-user',
                ),
            ),
        ));

        $this->assertEquals($processedConfiguration, array(
            'connection'    => array(
                'driver'    => 'mysql',
                'host'      => 'fake-host.tld',
                'database'  => 'fake-database-name',
                'username'  => 'fake-user',
                'password'  => '',
                'collation' => 'utf8_unicode_ci',
                'charset'   => 'utf8',
                'prefix'    => '',
            )
        ));
    }

    public function testValidHostPostgres()
    {
        $processor = new Processor();

        $processedConfiguration = $processor->processConfiguration(new Configuration(true), array(
            'cekurte_eloquent'  => array(
                'connection'    => array(
                    'driver'    => 'postgres',
                    'host'      => 'fake-host.tld',
                    'database'  => 'fake-database-name',
                    'username'  => 'fake-user',
                ),
            ),
        ));

        $this->assertEquals($processedConfiguration, array(
            'connection'    => array(
                'driver'    => 'postgres',
                'host'      => 'fake-host.tld',
                'database'  => 'fake-database-name',
                'username'  => 'fake-user',
                'password'  => '',
                'collation' => 'utf8_unicode_ci',
                'charset'   => 'utf8',
                'prefix'    => '',
            )
        ));
    }

    public function testValidHostSqlServer()
    {
        $processor = new Processor();

        $processedConfiguration = $processor->processConfiguration(new Configuration(true), array(
            'cekurte_eloquent'  => array(
                'connection'    => array(
                    'driver'    => 'sqlserver',
                    'host'      => 'fake-host.tld',
                    'database'  => 'fake-database-name',
                    'username'  => 'fake-user',
                ),
            ),
        ));

        $this->assertEquals($processedConfiguration, array(
            'connection'    => array(
                'driver'    => 'sqlserver',
                'host'      => 'fake-host.tld',
                'database'  => 'fake-database-name',
                'username'  => 'fake-user',
                'password'  => '',
                'collation' => 'utf8_unicode_ci',
                'charset'   => 'utf8',
                'prefix'    => '',
            )
        ));
    }

    public function testValidHostSqlite()
    {
        $processor = new Processor();

        $processedConfiguration = $processor->processConfiguration(new Configuration(true), array(
            'cekurte_eloquent'  => array(
                'connection'    => array(
                    'driver'    => 'sqlite',
                    'host'      => 'fake-host.tld',
                    'database'  => 'fake-database-name',
                    'username'  => 'fake-user',
                ),
            ),
        ));

        $this->assertEquals($processedConfiguration, array(
            'connection'    => array(
                'driver'    => 'sqlite',
                'host'      => 'fake-host.tld',
                'database'  => 'fake-database-name',
                'username'  => 'fake-user',
                'password'  => '',
                'collation' => 'utf8_unicode_ci',
                'charset'   => 'utf8',
                'prefix'    => '',
            )
        ));
    }

    public function testPassword()
    {
        $processor = new Processor();

        $processedConfiguration = $processor->processConfiguration(new Configuration(true), array(
            'cekurte_eloquent'  => array(
                'connection'    => array(
                    'host'      => 'fake-host.tld',
                    'database'  => 'fake-database-name',
                    'username'  => 'fake-user',
                    'password'  => '123',
                ),
            ),
        ));

        $this->assertEquals($processedConfiguration, array(
            'connection'    => array(
                'driver'    => 'mysql',
                'host'      => 'fake-host.tld',
                'database'  => 'fake-database-name',
                'username'  => 'fake-user',
                'password'  => '123',
                'collation' => 'utf8_unicode_ci',
                'charset'   => 'utf8',
                'prefix'    => '',
            )
        ));
    }

    public function testCollation()
    {
        $processor = new Processor();

        $processedConfiguration = $processor->processConfiguration(new Configuration(true), array(
            'cekurte_eloquent'  => array(
                'connection'    => array(
                    'host'      => 'fake-host.tld',
                    'database'  => 'fake-database-name',
                    'username'  => 'fake-user',
                    'collation' => 'fake',
                ),
            ),
        ));

        $this->assertEquals($processedConfiguration, array(
            'connection'    => array(
                'driver'    => 'mysql',
                'host'      => 'fake-host.tld',
                'database'  => 'fake-database-name',
                'username'  => 'fake-user',
                'password'  => '',
                'collation' => 'fake',
                'charset'   => 'utf8',
                'prefix'    => '',
            )
        ));
    }

    public function testCharset()
    {
        $processor = new Processor();

        $processedConfiguration = $processor->processConfiguration(new Configuration(true), array(
            'cekurte_eloquent'  => array(
                'connection'    => array(
                    'host'      => 'fake-host.tld',
                    'database'  => 'fake-database-name',
                    'username'  => 'fake-user',
                    'charset'   => 'fake',
                ),
            ),
        ));

        $this->assertEquals($processedConfiguration, array(
            'connection'    => array(
                'driver'    => 'mysql',
                'host'      => 'fake-host.tld',
                'database'  => 'fake-database-name',
                'username'  => 'fake-user',
                'password'  => '',
                'collation' => 'utf8_unicode_ci',
                'charset'   => 'fake',
                'prefix'    => '',
            )
        ));
    }

    public function testPrefix()
    {
        $processor = new Processor();

        $processedConfiguration = $processor->processConfiguration(new Configuration(true), array(
            'cekurte_eloquent'  => array(
                'connection'    => array(
                    'host'      => 'fake-host.tld',
                    'database'  => 'fake-database-name',
                    'username'  => 'fake-user',
                    'prefix'    => 'fake',
                ),
            ),
        ));

        $this->assertEquals($processedConfiguration, array(
            'connection'    => array(
                'driver'    => 'mysql',
                'host'      => 'fake-host.tld',
                'database'  => 'fake-database-name',
                'username'  => 'fake-user',
                'password'  => '',
                'collation' => 'utf8_unicode_ci',
                'charset'   => 'utf8',
                'prefix'    => 'fake',
            )
        ));
    }
}
