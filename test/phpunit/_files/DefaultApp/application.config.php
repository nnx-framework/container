<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */

use Nnx\Container\PhpUnit\TestData\TestPaths;
use Nnx\Container\Module;
use Nnx\ModuleOptions\Module as ModuleOptions;
use Nnx\EntryNameResolver\Module as EntryNameResolverModule;

return [
    'modules'                 => [
        ModuleOptions::MODULE_NAME,
        EntryNameResolverModule::MODULE_NAME,
        Module::MODULE_NAME
    ],
    'module_listener_options' => [
        'module_paths'      => [
            Module::MODULE_NAME => TestPaths::getPathToModule(),
        ],
        'config_glob_paths' => [
            __DIR__ . '/config/autoload/{{,*.}global,{,*.}local}.php',
        ],
    ]
];
