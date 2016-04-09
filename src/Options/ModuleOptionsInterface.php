<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container\Options;

/**
 * Interface ModuleOptionsInterface
 *
 * @package Nnx\Container\Options
 */
interface ModuleOptionsInterface
{
    /**
     * Возвращает список резолверов для определения имени "сервиса", исходя из контекста.
     *
     * @return array
     */
    public function getEntryNameResolvers();
}
