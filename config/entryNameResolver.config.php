<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container;

use Nnx\EntryNameResolver\EntryNameResolverManager;
use Nnx\Container\EntryNameResolver\DefaultEntryNameResolver;
use Nnx\Container\EntryNameResolver\DefaultEntryNameResolverFactory;
use Nnx\Container\EntryNameResolver\ResolverByModuleContextMap;
use Nnx\Container\EntryNameResolver\ResolverByModuleContextMapFactory;

return [
    EntryNameResolverManager::CONFIG_KEY => [
        'invokables'         => [

        ],
        'factories'          => [
            DefaultEntryNameResolver::class => DefaultEntryNameResolverFactory::class,
            ResolverByModuleContextMap::class => ResolverByModuleContextMapFactory::class
        ],
        'abstract_factories' => [

        ]
    ],
];


