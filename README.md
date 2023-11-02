## Что на данный момент можно использовать

## Инициалзиация 

```php
    $triggersFactory = new \triggers\Factory();
```

# Скрытые методы
- Регистрация контроллеров. Чтобы использовать роуты требуется зарегистрировать их
```bach
    vendor\lobster\triggers\src\lib\frameworks\{shell}\ShellWorker.php:registerControllers
```

- Регистрация хуков (событий). Требуюются для механизма автоматизации триггеров
```bach
    vendor\lobster\triggers\src\lib\frameworks\{shell}\ShellWorker.php:registerEvents
```

# Методы вызова

- Получение списка доступных роутов
```php
    $triggersFactory::$controllers->getRouteList();
```
- Вызов роута 
```php
    $triggersFactory::$controllers->call('triggers/entities/services')
```