<?php

declare(strict_types=1);

namespace Mdnr\Meilisearch\DependencyInjection;

use Monolog\Logger;
use Shopware\Core\DevOps\Environment\EnvironmentHelper;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('meilisearch');

        $debug = (bool) EnvironmentHelper::getVariable('APP_ENV', 'prod') !== 'prod';

        $treeBuilder->getRootNode()
        ->children()
            ->booleanNode('enabled')->end()
            ->booleanNode('indexing_enabled')->end()
            ->integerNode('indexing_batch_size')->defaultValue(100)->end()
            ->scalarNode('host')->end()
            ->scalarNode('master_key')->end()
            ->scalarNode('index_prefix')->end()
            ->scalarNode('throw_exception')->end()
            ->scalarNode('logger_level')->defaultValue($debug ? Logger::DEBUG : Logger::ERROR)->end()
        ->end();

        return $treeBuilder;
    }
}
