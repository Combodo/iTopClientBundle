<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 17/09/18
 * Time: 15:57
 */

namespace Combodo\ItopClientBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('combodo_itop_client');

        $rootNode
            ->children()
            ->arrayNode('servers')
                ->requiresAtLeastOneElement()
                ->arrayPrototype()
                    ->info('This key will be used in order to create the service: itop_client.rest_client.<key>')
                    ->children()
                        ->scalarNode('http_client')
                            ->cannotBeEmpty()
                            ->info('This is expected to be a Guzzle instance. You can provide your own in order. It let you leverage middleware and options. ')
                        ->end()
                        ->scalarNode('base_url')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->info('full path to the iTop\'s rest server, ie: http://localhost/itop/webservices/rest.php')
                        ->end()
                        ->scalarNode('auth_user')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('auth_pwd')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->arrayNode('extra_headers')
                            ->normalizeKeys(false)
                            ->ignoreExtraKeys(false)
                        ->end()
                        ->scalarNode('logger')
                            ->defaultValue('@logger')
                            ->info('The service Handling the logs')
                        ->end()
                    ->end()
                ->end() //arrayPrototype
                ->end() //servers
            ->end()
        ;

        return $treeBuilder;
    }
}
