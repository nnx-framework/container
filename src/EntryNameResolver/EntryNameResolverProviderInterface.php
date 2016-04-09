<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container\EntryNameResolver;

/**
 * Interface EntryNameResolverProviderInterface
 *
 * @package Nnx\Container\EntryNameResolver
 */
interface EntryNameResolverProviderInterface
{
    /**
     * Настройки для EntryNameResolverManager
     *
     * @return array
     */
    public function getEntryNameResolverConfig();
}
