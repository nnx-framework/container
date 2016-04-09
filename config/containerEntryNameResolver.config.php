<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container;

use Nnx\Container\EntryNameResolver\EntryNameResolverManager;
use Nnx\Container\EntryNameResolver\EntryNameResolverChain;
use Nnx\Container\EntryNameResolver\EntryNameResolverChainFactory;
use Nnx\Container\EntryNameResolver\ResolverByClassName;
use Nnx\Container\EntryNameResolver\ResolverByMap;
use Nnx\Container\EntryNameResolver\ResolverByMapFactory;

return [
    EntryNameResolverManager::CONFIG_KEY => [
        'invokables'         => [
            ResolverByClassName::class => ResolverByClassName::class
        ],
        'factories'          => [
            DefaultEntryNameResolverInterface::class => DefaultEntryNameResolverFactory::class,
            EntryNameResolverChain::class            => EntryNameResolverChainFactory::class,
            ResolverByMap::class                     => ResolverByMapFactory::class
        ],
        'abstract_factories' => [

        ]
    ],
];


