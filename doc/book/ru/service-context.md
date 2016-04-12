# Получение службы в зависимости от контекста

# Краткое описание

Контейнер \Nnx\Container\ContainerInterface расширяет функционал AbstractPluginManager'a позволяя в зависимости от контекста
вызова, определять какую службу необходим вернуть.

Для этого к методам get и has в качестве последнего аргумента можно передать контекст:

- Имя класса принадлежащий модулю, в контексте которого происходит вызов
- Объект инстанцированный от класса, принадлежащего модулю, в контексте котрого происходит вызов

Также добавлены следующие методы

Имя метода           |Описание
---------------------|----------------
getByContext         |Позволяет создать службу, указав ее имя, опции, и контекст
hasByContext         |Позволяет проверить есть ли возможность создать службу с заданным именем и контекстом
getEntryNameByContext|Позволяет получить имя службы, на основе базовго имени, для указанного контекста

Для определения имени службы в зависимости от контекста используется модуль [nnx-framework/entry-name-resolver](https://github.com/nnx-framework/entry-name-resolver).

# Управление механизмом определения имени службы в зависимости от контекста

Для определения имени службы используется цепочка resolver'ов. Используемые resolver'ы описываются в секции **entryNameResolvers**,
в рамках секции настроек модуля **nnx_container_module_options**.

Пример описания цепочки используемых resolver'ов:

```php

return [
    'nnx_container_module_options' => [
        'resolverByModuleContextMap' => [
            'name' => \Nnx\Container\EntryNameResolver\ResolverByModuleContextMap::class,
            'options' => [],
            'priority' => 1000
        ],
        'resolverByModuleContextMap' => [
            'name' => \Nnx\EntryNameResolver\ResolverByClassName::class,
            'priority' => 900
        ],
        'mirrorResolver' => [
            'name' => \Nnx\EntryNameResolver\EntryNameResolverMirror::class
        ],
    ];
];

```

Ключем является произвольная строка (в примере выше это resolverByModuleContextMap, resolverByModuleContextMap, mirrorResolver),
которая не нисет смысловой нагрузки, и используется только для того, что бы дать возможность переопределить конфиг в другом модуле.

Значением является массив со следующей структурой:

Имя ключа    |Обязательный|Тип   |
-------------|------------|------|--------------------------------------------------------------------------------------  
name         |да          |строка|Имя resolver'a, по данном имени он будет создаватсья с помощью \Nnx\EntryNameResolver\EntryNameResolverManagerInterface
options      |нет         |массив|Настройки используемые при создание resolver'a
priority     |нет         |число |Приоритет в очереди

## \Nnx\Container\EntryNameResolver\ResolverByModuleContextMap - определение имени службы с помощью конфигурационной карты

Данный resolver использует специальный конфиг для определения имени службы в зависимости от контекста.
Пример использования конфига:

```php

namespace MyModule;

use BaseModule;

return [
    'nnx_container_module_options' => [
        'contextMap' => [
            BaseModule\ServiceInterface::class => [
                'MyModule' => MyModule\Service::class
            ]
        ]
    ];
];

```

Более детальное описание работы данного resolver'a можно найи в [документации](http://entry-name-resolver.readthedocs.org/ru/latest/resolver-by-module-context-map/).
**Важно, что для настройки необходимо использовать секцию 'contextMap', в настройках модуля (секция 'nnx_container_module_options')**

##  \Nnx\EntryNameResolver\ResolverByClassName - определение имени службы, для модулей с одинаковой структурой

Детальное описание resolver'a - (ResolverByClassName)[http://entry-name-resolver.readthedocs.org/ru/latest/resolver-by-class-name/]

##  \Nnx\EntryNameResolver\EntryNameResolverMirror - Если не удалось определить имя службы.

Если не удалось в зависимосит от контекста определить имя службы, то возвращается то же имя что было при запросе.

Детальное описание resolver'a - (EntryNameResolverMirror)[http://entry-name-resolver.readthedocs.org/ru/latest/entry-name-resolver-mirror/]



















    