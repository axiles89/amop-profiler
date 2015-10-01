Amop Profiler Sender
============================

Библиотека для отправки данных по логированию, профилированию на проект `amop.ru`. 

Установка
-------------------
 
Установка с помощью пакета composer `"axiles89/amop-profiler": "dev"`


Применение
------------

Профайлер собирает данные по профилирование, логированию вашего проекта и отправляет их на проект `Amop` в `json` формате 
после завершения работы приложения.


Пример использования
------------

### Yii2

Установить в `params.php` id, секретный ключ вашего проекта, а также host проекта amop:

```php
<?php
    return [
        ...
        'projectKey' => 'K0YQClI7jpXK7ToijFCO2PcaUZIjeD',
        'projectId' => 15,
        'amopHost' => 'http://www.amop.ru',
        ...
    ];
```

Добавить в `web.php` соответсвующий обработчик события завершения работы приложения:
```
    'on afterRequest' => function ($event) {
        $message = \axiles89\profiler\Profiler::getLogger()->createMessage();
        $report = new \axiles89\profiler\Reporter\Reporter(/* project ID */, /* project KEY */, /* host */);
        $report->sendReport($message);
    }
```

После этого достаточно заключить нужные участки кода в соответствующие блоки и библиотека отправит все данные по завершению работы приложения. Профайлер поддерживает также и вложенные вызовы блоков:

```
        \axiles89\profiler\Profiler::startProfiler("Test profiler");
            Блок 1
                \axiles89\profiler\Profiler::startProfiler("Test 2");
                 Блок 2
                \axiles89\profiler\Profiler::endProfiler("Test 2");
            Блок 1
        \axiles89\profiler\Profiler::endProfiler("Test profiler");
```

### Настройки

Если вас не устраивает стандартный компонент `Logger`, который собирает базовые данные по профилированию, то вы всегда
можете создать любой из расширенных logger-ов, установив затем его для `Profiler`:

```
    $logger = new axiles89\profiler\Logger\Logger();
    Profiler::setLogger($logger);
```

Каждый `Logger` имеет `Factory` объект для формирования нужного типа сообщения из данных, которые он собрал. Если вас не усраивает тип соответсвующего сообщения, то вы можете установить нужный объект `Factory` для logger-а:

```
    $factory = new axiles89\profiler\MessageFactory\MessageFactory();
    $logger = new axiles89\profiler\Logger\Logger();
    $logger->setFactoryMessage($factory);
```

Также можно сконфигурировать `Adapter` отправки сообщений, по умоланию используется `Curl`

```
    $report->setAdapter(new \axiles89\profiler\Reporter\Sender\CurlSender);
```
