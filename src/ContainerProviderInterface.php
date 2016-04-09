<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container;

/**
 * Interface ContainerProviderInterface
 *
 * @package Nnx\Container
 */
interface ContainerProviderInterface
{
    /**
     * Настройки контейнера
     *
     * @return array
     */
    public function getContainerConfig();
}
