<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container\PhpUnit\Test;

use Nnx\Container\Container;
use Nnx\Container\PhpUnit\TestData\TestPaths;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Nnx\Container\ContainerInterface;
use Nnx\Container\PhpUnit\TestData\ContextResolver\Custom\Service as ServiceApp;

/**
 * Class ContainerFunctionalTest
 *
 * @package Nnx\Container\PhpUnit\Test
 */
class ContainerFunctionalTest extends AbstractHttpControllerTestCase
{

    /**
     * @inheritdoc
     *
     * @throws \Zend\Stdlib\Exception\LogicException
     */
    protected function setUp()
    {
        /** @noinspection PhpIncludeInspection */
        $this->setApplicationConfig(
            include TestPaths::getPathToContextResolverAppConfig()
        );

        parent::setUp();
    }


    /**
     * Тестирование получения службы по контексту
     *
     * @return array
     */
    public function dataTestGetEntryByContext()
    {
        return [
            ['testResolveServiceByConfig', ServiceApp\Module3\Module::class, ServiceApp\Module3\ResolvedServiceByConfigFromModule3Context::class],
            ['testResolveServiceByConfig', ServiceApp\Module2\Module::class, ServiceApp\Module2\ResolvedServiceByConfigFromModule2Context::class],
            [ServiceApp\Module3\Service\ComponentInterface::class, ServiceApp\Module3\Module::class, ServiceApp\Module3\ResolvedServiceByConfigFromModule3Context::class],
            [ServiceApp\Module3\Service\ComponentInterface::class, ServiceApp\Module2\Module::class, ServiceApp\Module2\Service\Component::class]
        ];
    }


    /**
     * Проверка ситуации когда пытаемся получить сервис, который:
     * 1) Не может быть разрезолвен в другой, в зависимости от контекста
     * 2) Не зарегестрирован в ServiceLocator приложения
     *
     *
     * @expectedException \Zend\ServiceManager\Exception\ServiceNotFoundException
     * @expectedExceptionMessage Nnx\Container\Container::get was unable to fetch or create an instance for
     *
     *
     * @return void
     *
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     * @throws \Zend\Stdlib\Exception\LogicException
     */
    public function testLoadModule()
    {
        /** @var ContainerInterface $container */
        $container = $this->getApplicationServiceLocator()->get(ContainerInterface::class);

        $entryName = 'UnknownService';
        $container->get($entryName);
    }


    /**
     * Тестирование получени службы, в зависимости от контекста
     *
     * @dataProvider dataTestGetEntryByContext
     *
     * @param $entryName
     * @param $context
     * @param $expectedEntryClassName
     *
     * @throws \Zend\Stdlib\Exception\LogicException
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function testGetEntryByContext($entryName, $context, $expectedEntryClassName)
    {
        /** @var ContainerInterface $container */
        $container = $this->getApplicationServiceLocator()->get(ContainerInterface::class);

        static::assertInstanceOf($expectedEntryClassName, $container->get($entryName, [], null, $context));
        static::assertInstanceOf($expectedEntryClassName, $container->getByContext($entryName, [], $context));
        static::assertTrue($container->has($entryName, true, true, $context));
        static::assertTrue($container->hasByContext($entryName, $context));
    }

    /**
     *  Проверка getter/setter для свойства flagUsePeeringServiceManagers
     *
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function testSetterGetterFlagUsePeeringServiceManagers()
    {
        /** @var Container $container */
        $container = $this->getApplicationServiceLocator()->get(ContainerInterface::class);

        static::assertEquals($container, $container->setFlagUsePeeringServiceManagers(true));
        static::assertTrue($container->getFlagUsePeeringServiceManagers());
    }


    /**
     *  Проверка getter/setter для свойства flagCheckAbstractFactories
     *
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function testSetterGetterFlagCheckAbstractFactories()
    {
        /** @var Container $container */
        $container = $this->getApplicationServiceLocator()->get(ContainerInterface::class);

        static::assertEquals($container, $container->setFlagCheckAbstractFactories(false));
        static::assertFalse($container->getFlagCheckAbstractFactories());
    }
}
