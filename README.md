## Что на данный момент можно использовать

### Инициалзиация 

```php
    $triggersFactory = new \triggers\Factory();
```

## Скрытые обязательные методы инициализирующие работу оболочек
`{shell}` является оболочкой (фреймворком) который запускается в той среде где установлен пакет

- Регистрация контроллеров. Чтобы использовать роуты требуется зарегистрировать их
```bach
    src\lib\frameworks\{shell}\ShellWorker.php:registerControllers
```

- Регистрация хуков (событий). Требуются для механизма автоматизации триггеров
```bach
    src\lib\frameworks\{shell}\ShellWorker.php:registerEvents
```

- Регистрация моделей
```bach
    src\lib\frameworks\{shell}\ShellWorker.php:registerModels
```

## Методы

- Получение списка доступных роутов
```php
    $triggersFactory::$controllers->getRouteList();
```
- Вызов роута 
```php
    $triggersFactory::$controllers->call('triggers/entities/services')
```
- Название вызванной оболочки
```php
    $triggersFactory::$shellName
```
- Модели. Они соответсвуют моделям полученным при загрузке оболочки из `src\lib\frameworks\{shell}\models\`

```php
    $triggersFactory::$models->triggers::class
    $triggersFactory::$models->triggersActions::class
    $triggersFactory::$models->triggersHistory::class
```

- Основной обслуживающий сервис
```php
    $triggersFactory::$service
```

- Репозиторий. Является адаптером в использовании моделей фреймворков
```php
    $triggersFactory::$service::$repository
```

- Сервис отвественный за срабатывание триггеров
```php
    $triggersFactory::$service::$event
```

## Требущее особое внимание

#### Загрузка оболочек
Оболочки загружаются в с помощью базовой реализации лоадера `src\images\ShellLoader.php` по средствам воркеров. Сам воркер устанавливается в папку с фреймворком `src\lib\frameworks\{shell}\ShellWorker.php` и уже в них прописывается логика требующая для нормальной работы пакета. Чтобы добавить или удалить загрузчик оболочки требуется внести изменения в `src\Config.php::SHELL_LIST`.

#### Система автоматизации
Логику работы системы автоматизации я перенес в модели `src\lib\frameworks\{shell}\models\`, что является неверным решением в пользу репозитория, в котором должны быть прописаны адаптеры для работы с моделями разных фреймворках. Это требуется доработать!

#### Система триггеров
Сервис, в котором находится логика, является `src\lib\TriggerEventService.php`. Необходимо переместить логику работы триггеров из моделей в репозиторий. Чтобы адаптировать работу событий для каждой из оболочек требуется прописать логику в `src\lib\TriggerEventService.php:translateShellEvent` на выходе которой будет объект `ShellEventData`.

#### Установка триггеров
События регистрируются в `src\lib\frameworks\{shell}\ShellWorker.php:registerEvents`. В этом методе требуется установка прослушивателей, либо их регистрация в используемом фреймворке.

#### Работа контроллеров
Базовая работа контроллера находится в `src\images\BaseController.php`. Оно использует `$triggersFactory::$config::SERVICES_LIST` для создания роутов и их загрузку. В контроллерах требуется создать публичный метод для возможности его вызова. За работу самого контроллера и возможности его вызова отвечате воркер `src\lib\ControllerWorker.php`, доступ к которому можно получить из `Factory::$controllers`.