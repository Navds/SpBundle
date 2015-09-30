<?php

namespace LightSaml\SpBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class TrustOptionsStoreCompilerPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        if (false === $container->has('light_saml_sp.party.trust_options_store')) {
            return;
        }

        $definition = $container->findDefinition('light_saml_sp.party.trust_options_store');

        $taggedServices = $container->findTaggedServiceIds('lightsaml.trust_options_store');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('add', [new Reference($id)]);
        }
    }
}