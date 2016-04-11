<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container\EntryNameResolver;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Nnx\ModuleOptions\ModuleOptionsPluginManagerInterface;
use Nnx\Container\Options\ModuleOptions;
use Nnx\EntryNameResolver\ResolverByModuleContextMap as BaseResolverByModuleContextMap;


/**
 * Class ResolverByModuleContextMapFactory
 *
 * @package Nnx\Container\EntryNameResolver
 */
class ResolverByModuleContextMapFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return ResolverByModuleContextMap
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
        $contextMap = $moduleOptions->getContextMap();

        $creationOptions = [
            'contextMap' => $contextMap,
            'className' => ResolverByModuleContextMap::class
        ];

        $entryNameResolverChain = $serviceLocator->get(BaseResolverByModuleContextMap::class, $creationOptions);

        return $entryNameResolverChain;
    }
}
