<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 17/09/18
 * Time: 15:57
 */

namespace Combodo\ItopClientBundle\DependencyInjection;


use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('itop_client');

        $rootNode
            ->arrayNode('clients')
                ->children()
                    ->scalarNode('http_client')
                    ->end()
                        ->scalarNode('base_url')
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
                    ->scalarNode('auth_user')
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
                    ->scalarNode('auth_pwd')
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
        //                        ->append($this->addExtraHeadersNode())
                    ->arrayNode('extra_headers')
                        ->normalizeKeys(false)
                        ->ignoreExtraKeys(false)
                    ->end()
                ->end()
            ->end() //clients
        ;

        return $treeBuilder;
    }

//    public function addExtraHeadersNode()
//    {
//        $treeBuilder = new TreeBuilder();
//        $node = $treeBuilder->root('extra_headers');
//
//        $node
//            ->useAttributeAsKey('name')
//                ->arrayPrototype()
//                    ->children()
//                    ->scalarNode('value')
//                        ->isRequired()
//                        ->cannotBeEmpty()
//                    ->end()
//                ->end()
//            ->end()
//        ;
//
//        return $node;
//    }
}