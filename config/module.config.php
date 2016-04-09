<?php
/**
 * @link    https://github.com/nnx-framework/container
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Nnx\Container;

use Nnx\Container\EntryNameResolver\ResolverByClassName;
use Nnx\Container\EntryNameResolver\ResolverByMap;

$config = [
    Module::CONFIG_KEY => [
        /**
         * Список резолверов для определения имени "сервиса", исходя из контекста. Формат данных следующий:
         * 'entryNameResolvers' => [
         *      'произвольныйКлюч' => [
         *          //Должен быть зарегестрирован в \Nnx\Container\Container. Обязательный параметр
         *          'name' => 'имяРезолвера',
         *          //Настройки резолвера. Не обязательный параметр
         *          'options' => [],
         *          //Приоритет в цепочке резолверов
         *          'priority' => 1
         *      ]
         * ]
         */
        'entryNameResolvers' => [
            ResolverByClassName::class => [
                'name' => ResolverByClassName::class
            ],
            ResolverByMap::class => [
                'name' => ResolverByMap::class,
                'options' => [
                    'configKey' => ''
                ]
            ]
        ],
        /**
         * Карта используемая для определения имени сервиса в зависимости от контекста вызова
         *
         * 'имяСервиса' => [
         *      'имяМодуля' => 'имяСервисаДляЭтогоМодуля'
         * ]
         *
         */
        'contextMap' => [

        ]
    ]
];

return array_merge_recursive(
    include __DIR__ . '/container.config.php',
    include __DIR__ . '/containerEntryNameResolver.config.php',
    include __DIR__ . '/serviceManager.config.php',
    $config
);