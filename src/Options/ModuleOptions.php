<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container\Options;

use Zend\Stdlib\AbstractOptions;
use Nnx\ModuleOptions\ModuleOptionsInterface;


/**
 * Class ModuleOptions
 *
 * @package Nnx\Container\Options
 */
class ModuleOptions extends AbstractOptions implements ModuleOptionsInterface
{
    /**
     * Список резолверов для определения имени "сервиса", исходя из контекста.
     *
     * @var array
     */
    protected $entryNameResolvers = [];

    /**
     * Карта используемая для определения имени сервиса в зависимости от контекста вызова
     *
     * @var array
     */
    protected $contextMap = [];

    /**
     * @inheritdoc
     *
     * @return array
     */
    public function getEntryNameResolvers()
    {
        return $this->entryNameResolvers;
    }

    /**
     * Устанавливает список резолверов для определения имени "сервиса", исходя из контекста.
     *
     * @param array $entryNameResolvers
     *
     * @return $this
     */
    public function setEntryNameResolvers(array $entryNameResolvers = [])
    {
        $this->entryNameResolvers = $entryNameResolvers;

        return $this;
    }

    /**
     * Возвращает карту используемую для определения имени сервиса в зависимости от контекста вызова
     *
     * @return array
     */
    public function getContextMap()
    {
        return $this->contextMap;
    }

    /**
     * Устанавливает карту используемую для определения имени сервиса в зависимости от контекста вызова
     *
     * @param array $contextMap
     *
     * @return $this
     */
    public function setContextMap(array $contextMap = [])
    {
        $this->contextMap = $contextMap;

        return $this;
    }
}
