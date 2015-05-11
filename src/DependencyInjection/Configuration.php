<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\EloquentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('cekurte_eloquent');

        $rootNode
            ->children()
                ->arrayNode('connection')
                    ->children()
                        ->scalarNode('driver')
                            ->cannotBeEmpty()
                            ->defaultValue('mysql')
                            ->validate()
                            ->ifNotInArray(array('mysql', 'postgres', 'sqlserver', 'sqlite'))
                                ->thenInvalid('Invalid database driver "%s"')
                            ->end()
                        ->end()
                        ->scalarNode('host')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('database')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('username')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('password')
                            ->defaultValue('')
                        ->end()
                        ->scalarNode('collation')
                            ->cannotBeEmpty()
                            ->defaultValue('utf8_unicode_ci')
                        ->end()
                        ->scalarNode('charset')
                            ->cannotBeEmpty()
                            ->defaultValue('utf8')
                        ->end()
                        ->scalarNode('prefix')
                            ->cannotBeEmpty()
                            ->defaultValue('')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
