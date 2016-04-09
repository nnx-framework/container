<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Nnx\Container\EntryNameResolver\EntryNameResolverChain;
use Nnx\ModuleOptions\ModuleOptionsPluginManagerInterface;
use Nnx\Container\Options\ModuleOptions;

/**
 * Class DefaultEntryNameResolverFactory
 *
 * @package Nnx\Container
 */
class DefaultEntryNameResolverFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return DefaultEntryNameResolverInterface
     *
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

        $entryNameResolverChain = $serviceLocator->get(EntryNameResolverChain::class, $entryNameResolversConfig);

        return $entryNameResolverChain;
    }
}
