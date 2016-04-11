<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container\EntryNameResolver;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Nnx\EntryNameResolver\EntryNameResolverChain;
use Nnx\ModuleOptions\ModuleOptionsPluginManagerInterface;
use Nnx\Container\Options\ModuleOptions;

/**
 * Class DefaultEntryNameResolverFactory
 *
 * @package Nnx\Container\EntryNameResolver
 */
class DefaultEntryNameResolverFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return DefaultEntryNameResolver
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $appServiceLocator = $serviceLocator;
        if ($serviceLocator instanceof AbstractPluginManager) {
            $appServiceLocator = $serviceLocator->getServiceLocator();
        }

        /** @var ModuleOptionsPluginManagerInterface $moduleOptionsPluginManager */
        $moduleOptionsPluginManager = $appServiceLocator->get(ModuleOptionsPluginManagerInterface::class);

        /** @var ModuleOptions $moduleOptions */
        $moduleOptions = $moduleOptionsPluginManager->get(ModuleOptions::class);
        $entryNameResolversConfig = $moduleOptions->getEntryNameResolvers();

        $creationOptions = [
            'resolvers' => $entryNameResolversConfig,
            'className' => DefaultEntryNameResolver::class
        ];

        $entryNameResolverChain = $serviceLocator->get(EntryNameResolverChain::class, $creationOptions);

        return $entryNameResolverChain;
    }
}
