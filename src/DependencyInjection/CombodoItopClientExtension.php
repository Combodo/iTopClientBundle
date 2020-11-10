<?php
/**
 * Created by Bruno DA SILVA, working for Combodo
 * Date: 17/09/18
 * Time: 11:47
 */

namespace Combodo\ItopClientBundle\DependencyInjection;


use Combodo\ItopClientBundle\RestClient\RestClient;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class CombodoItopClientExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        //the default http client (should probalby always be used, but this decoupling come at no cost)
        $defaultHttpClient = new Definition(\GuzzleHttp\Client::class,[]);
        $defaultHttpClient->setLazy(true);
        $container->setDefinition('itop_client.default_http_client',$defaultHttpClient);

        //each server configured
        foreach ($config['servers'] as $alias => $serverConfig) {
            $serviceName = sprintf('itop_client.rest_client.%s', $alias);

            if (empty($serverConfig['logger'])) {
                $logger = null;
            } else if (substr($serverConfig['logger'], 0, 1) == '@') {
                $logger = new Reference(
                    substr($serverConfig['logger'], 1)
                );
            } else {
                throw new \Exception('The "logger" must start with a @');
            }

            $definition  = new Definition(
                RestClient::class,
                [
                    $serverConfig['http_client'] ?? $defaultHttpClient,
                    $serverConfig['base_url'],
                    $serverConfig['auth_user'],
                    $serverConfig['auth_pwd'],
                    $serverConfig['extra_headers'] ?? [],
                    $logger
                ]
            );
            $definition->setLazy(true);
            $container->setDefinition($serviceName, $definition);
        }
    }

}