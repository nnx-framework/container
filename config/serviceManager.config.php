<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container;


use Nnx\Container\EntryNameResolver\EntryNameResolverManager;

return [
    'service_manager' => [
        'invokables'         => [
            EntryNameResolverManager::class => EntryNameResolverManager::class
        ],
        'factories'          => [
            ContainerInterface::class => ContainerFactory::class
        ],
        'abstract_factories' => [

        ]
    ],
];


