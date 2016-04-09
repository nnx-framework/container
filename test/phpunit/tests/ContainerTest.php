<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container\PhpUnit\Test;

use Nnx\Container\PhpUnit\TestData\TestPaths;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Nnx\Container\Module;

/**
 * Class ContainerTest
 *
 * @package Nnx\Container\PhpUnit\Test
 */
class ContainerTest extends AbstractHttpControllerTestCase
{
    /**
     *
     * @return void
     * @throws \Zend\Stdlib\Exception\LogicException
     */
    public function testLoadModule()
    {
        /** @noinspection PhpIncludeInspection */
        $this->setApplicationConfig(
            include TestPaths::getPathToContextResolverAppConfig()
        );

        $this->assertModulesLoaded([Module::MODULE_NAME]);
    }
}
