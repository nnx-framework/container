<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container\PhpUnit\TestData\ContextResolver\Custom\Service\Module3;

use Nnx\Container\Module as ContainerModule;


return [
    ContainerModule::CONFIG_KEY => [
        'contextMap' => [
            'testResolveServiceByConfig' => [
                Module::MODULE_NAME => ResolvedServiceByConfigFromModule3Context::class
            ],
            Service\ComponentInterface::class => [
                Module::MODULE_NAME => ResolvedServiceByConfigFromModule3Context::class
            ]
        ]
    ],
    Module::CONFIG_KEY => [

    ]
];