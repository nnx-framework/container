<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container\Options;

use Zend\Stdlib\AbstractOptions;
use Nnx\ModuleOptions\ModuleOptionsInterface;
use Nnx\Container\Options\ModuleOptionsInterface as CurrentModuleOptionsInterface;


/**
 * Class ModuleOptions
 *
 * @package Nnx\Container\Options
 */
class ModuleOptions extends AbstractOptions implements ModuleOptionsInterface, CurrentModuleOptionsInterface
{
    /**
     * Список резолверов для определения имени "сервиса", исходя из контекста.
     *
     * @var array
     */
    protected $entryNameResolvers = [];

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
}
