<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Nnx\Container\EntryNameResolver\EntryNameResolverManager;

/**
 * Class ContainerFactory
 *
 * @package Nnx\Container
 */
class ContainerFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return Container
     *
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var EntryNameResolverManager $entryNameResolverManager */
        $entryNameResolverManager = $serviceLocator->get(EntryNameResolverManager::class);

        /** @var DefaultEntryNameResolverInterface $defaultEntryNameResolver */
        $defaultEntryNameResolver = $entryNameResolverManager->get(DefaultEntryNameResolverInterface::class);

        return new Container($defaultEntryNameResolver);
    }
}
