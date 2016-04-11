<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container;

use Nnx\EntryNameResolver\EntryNameResolverManagerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Nnx\Container\EntryNameResolver\DefaultEntryNameResolver;

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
        /** @var EntryNameResolverManagerInterface $entryNameResolverManager */
        $entryNameResolverManager = $serviceLocator->get(EntryNameResolverManagerInterface::class);

        /** @var DefaultEntryNameResolver $defaultEntryNameResolver */
        $defaultEntryNameResolver = $entryNameResolverManager->get(DefaultEntryNameResolver::class);

        return new Container($defaultEntryNameResolver);
    }
}
