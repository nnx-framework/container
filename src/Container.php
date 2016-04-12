<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ConfigInterface;
use Nnx\EntryNameResolver\EntryNameResolverInterface;

/**
 * Class Container
 *
 * @package Nnx\Container
 */
class Container extends AbstractPluginManager implements ContainerInterface
{
    /**
     * Имя секции в конфиги приложения отвечающей за настройки контейнера
     *
     * @var string
     */
    const CONFIG_KEY = 'nnx_container';

    /**
     * Флаг определяющий нужно ли производить поиск по $id в связанных ServiceManager'ах
     *
     * @var bool
     */
    protected $flagUsePeeringServiceManagers = false;

    /**
     * Флаг определяет, нужно ли задействовать абстрактные фабрики, при поиске по $id
     *
     * @var bool
     */
    protected $flagCheckAbstractFactories = true;

    /**
     * Резолвер для получения имени создаваемой сущщности
     *
     * @var EntryNameResolverInterface
     */
    protected $entryNameResolver;

    /**
     * Container constructor.
     *
     * @param EntryNameResolverInterface $entryNameResolver
     * @param ConfigInterface|null       $configuration
     */
    public function __construct(EntryNameResolverInterface $entryNameResolver, ConfigInterface $configuration = null)
    {
        $this->setEntryNameResolver($entryNameResolver);
        parent::__construct($configuration);
    }


    /**
     * @inheritdoc
     *
     * @param string     $id
     * @param array|null $options
     * @param null       $context
     *
     * @return mixed
     */
    public function get($id, array $options = [], $usePeeringServiceManagers = true, $context = null)
    {
        $resolvedId = $this->getEntryNameByContext($id, $context);
        return parent::get($resolvedId, $options, $usePeeringServiceManagers);
    }

    /**
     * @inheritdoc
     *
     * @param array|string $id
     * @param null         $context
     *
     * @return bool|void
     *
     */
    public function has($name, $checkAbstractFactories = true, $usePeeringServiceManagers = true, $context = null)
    {
        if (is_array($name)) {
            return parent::has($name, $checkAbstractFactories, $usePeeringServiceManagers);
        }
        $resolvedId = $this->getEntryNameByContext($name, $context);
        return parent::has($resolvedId, $checkAbstractFactories, $usePeeringServiceManagers);
    }

    /**
     * Проверить есть ли  служба исходя из контекста вызова
     *
     * @param $name
     * @param $context
     *
     * @return bool|void
     */
    public function hasByContext($name, $context)
    {
        $resolvedId = $this->getEntryNameByContext($name, $context);
        $checkAbstractFactories = $this->getFlagCheckAbstractFactories();
        $usePeeringServiceManagers = $this->getFlagUsePeeringServiceManagers();

        return $this->has($resolvedId, $checkAbstractFactories, $usePeeringServiceManagers, $context);
    }

    /**
     * Получить службу исходя из контекста вызова
     *
     * @param       $name
     * @param array $options
     * @param       $context
     *
     * @return mixed
     *
     * @throws \Zend\ServiceManager\Exception\RuntimeException
     * @throws \Zend\ServiceManager\Exception\ServiceNotCreatedException
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function getByContext($name, array $options = [], $context)
    {
        $usePeeringServiceManagers = $this->getFlagUsePeeringServiceManagers();
        return $this->get($name, $options, $usePeeringServiceManagers, $context);
    }

    /**
     * @inheritdoc
     *
     * @param string $id
     * @param null   $context
     *
     * @return string|void
     */
    public function getEntryNameByContext($id, $context = null)
    {
        return $this->getEntryNameResolver()->resolveEntryNameByContext($id, $context);
    }

    /**
     * @inheritdoc
     *
     * @param mixed $plugin
     *
     * @return bool
     */
    public function validatePlugin($plugin)
    {
        return true;
    }

    /**
     * Возвращает флаг определяющий нужно ли производить поиск по $id в связанных ServiceManager'ах
     *
     * @return boolean
     */
    public function getFlagUsePeeringServiceManagers()
    {
        return $this->flagUsePeeringServiceManagers;
    }

    /**
     * Устанавливает флаг определяющий нужно ли производить поиск по $id в связанных ServiceManager'ах
     *
     * @param boolean $flagUsePeeringServiceManagers
     *
     * @return $this
     */
    public function setFlagUsePeeringServiceManagers($flagUsePeeringServiceManagers)
    {
        $this->flagUsePeeringServiceManagers = (bool)$flagUsePeeringServiceManagers;

        return $this;
    }

    /**
     * Возвращает флаг определяяющий, нужно ли задействовать абстрактные фабрики, при поиске по $id
     *
     * @return boolean
     */
    public function getFlagCheckAbstractFactories()
    {
        return $this->flagCheckAbstractFactories;
    }

    /**
     * Устанавливает флаг определяяющий, нужно ли задействовать абстрактные фабрики, при поиске по $id
     *
     * @param boolean $flagCheckAbstractFactories
     *
     * @return $this
     */
    public function setFlagCheckAbstractFactories($flagCheckAbstractFactories)
    {
        $this->flagCheckAbstractFactories = (bool)$flagCheckAbstractFactories;

        return $this;
    }

    /**
     * Возвращает резолвер для получения имени создаваемой сущщности
     *
     * @return EntryNameResolverInterface
     */
    public function getEntryNameResolver()
    {
        return $this->entryNameResolver;
    }

    /**
     * Устанавливает резолвер для получения имени создаваемой сущщности
     *
     * @param EntryNameResolverInterface $entryNameResolver
     *
     * @return $this
     */
    public function setEntryNameResolver($entryNameResolver)
    {
        $this->entryNameResolver = $entryNameResolver;

        return $this;
    }
}
