<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container;

use Interop\Container\ContainerInterface as BaseContainerInterface;

/**
 * Interface ContainerInterface
 *
 * @package Nnx\Container
 */
interface ContainerInterface extends BaseContainerInterface
{
    /**
     * Получение сервиса из контейнера
     *
     * @param string $id
     * @param array  $options
     *
     * @param mixed   $context
     *
     * @return mixed
     */
    public function get($id, array $options = null, $context = null);

    /**
     * Проверяет возможность получить сервис из данного контейнера
     *
     * @param string $id
     *
     * @param mixed   $context
     *
     * @return bool
     */
    public function has($id, $context = null);

    /**
     * Возвращает имя сервиса, в зависимости от контекста вызова
     *
     * @param string $id
     * @param null $context
     *
     * @return string
     */
    public function getServiceNameByContext($id, $context = null);
}
