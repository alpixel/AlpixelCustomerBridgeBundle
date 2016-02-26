<?php

namespace Alpixel\Bundle\CustomerBridgeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('alpixel_customer_bridge');

        $rootNode
            ->children()
                ->scalarNode('jira_project_name')
                    ->cannotBeEmpty()
                    ->isRequired()
                ->end()
                ->scalarNode('token')
                    ->cannotBeEmpty()
                    ->isRequired()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
