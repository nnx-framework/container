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
     * Получение объекта из контейнера
     *
     * @param string $id
     * @param array  $options
     *
     * @param bool   $usePeeringServiceManagers
     * @param mixed  $context
     *
     * @return mixed
     */
    public function get($id, array $options = [], $usePeeringServiceManagers = true, $context = null);

    /**
     * Получить службу исходя из контекста вызова
     *
     * @param       $name
     * @param array $options
     * @param       $context
     *
     * @return mixed
     */
    public function getByContext($name, array $options = [], $context);

    /**
     * Проверяет возможность получить объект из данного контейнера
     *
     * @param string $name
     * @param bool   $checkAbstractFactories
     * @param bool   $usePeeringServiceManagers
     * @param mixed  $context
     *
     * @return bool
     *
     */
    public function has($name, $checkAbstractFactories = true, $usePeeringServiceManagers = true, $context = null);

    /**
     * Проверить есть ли  служба исходя из контекста вызова
     *
     * @param $name
     * @param $context
     *
     * @return bool
     */
    public function hasByContext($name, $context);

    /**
     * Возвращает имя, по которому можно получить объект из контейнера, в зависимости от контекста вызова
     *
     * @param string $id
     * @param null $context
     *
     * @return string
     */
    public function getEntryNameByContext($id, $context = null);
}
