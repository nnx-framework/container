<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container\EntryNameResolver;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\MutableCreationOptionsInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\MutableCreationOptionsTrait;

/**
 * Class ResolverByMapFactory
 *
 * @package Nnx\Container\EntryNameResolver
 */
class ResolverByMapFactory implements FactoryInterface, MutableCreationOptionsInterface
{
    use MutableCreationOptionsTrait;

    /**
     * @inheritdoc
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return ResolverByMap
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $creationOptions = $this->getCreationOptions();
        $options = is_array($creationOptions) ? $creationOptions : [];




        return new ResolverByMap();
    }
}
