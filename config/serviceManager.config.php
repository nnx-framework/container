<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container;

return [
    'service_manager' => [
        'invokables'         => [

        ],
        'factories'          => [
            ContainerInterface::class => ContainerFactory::class
        ],
        'abstract_factories' => [

        ]
    ],
];


