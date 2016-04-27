<?php

namespace Grossum\NewsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('grossum_news');

        $rootNode
            ->children()
                ->arrayNode('class')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('news')->defaultValue('Application\\Grossum\\NewsBundle\\Entity\\News')
                        ->end()
                        ->scalarNode('news_tag')->defaultValue('Application\\Grossum\\NewsBundle\\Entity\\NewsTag')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('table')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('news_to_tag')->defaultValue('grossum_news_to_tag')
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
