# Triggers
Бизнес требования заключаются в создании одной библиотеки для работы с событиями под управлением Yii2 и Laravel. Модуль призван решить проблемы разности работы глобальных событий и облегчить работу с моделями разных фреймворках

### Инициалзиация 

```php
    $triggersBoot = new \triggers\Boot();
```

## Скрытые обязательные методы инициализирующие работу оболочек
`{shell}` является оболочкой (фреймворком) который запускается в той среде где установлен пакет (см. `\triggers\Config.php::SHELL_LIST`)

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
    $triggersBoot::$controllers->getRouteList();
```
- Вызов роута 
```php
    $triggersBoot::$controllers->call('triggers/entities/services')
```
- Название вызванной оболочки
```php
    $triggersBoot::$shellName
```
- Модели. Они соответсвуют моделям полученным при загрузке оболочки из `src\lib\frameworks\{shell}\models\`

```php
    $triggersBoot::$models->triggers::class
    $triggersBoot::$models->triggersActions::class
    $triggersBoot::$models->triggersHistory::class
```

- Основной обслуживающий сервис
```php
    $triggersBoot::$service
```

- Репозиторий. Является адаптером в использовании моделей фреймворков
```php
    $triggersBoot::$service::$repository
```

- Сервис отвественный за срабатывание триггеров
```php
    $triggersBoot::$service::$event
```

- Регистрация модуля в Laravel
```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    ...
    public function boot()
    {
        new \triggers\Boot();
    }
    ...
}
```

- Регистрация модуля в Yii. Требуется прописать в конфиг модуль и загрузчик:
```php
$config = [
    ...
    'bootstrap' => [
        ...
        'triggers'
    ],
    'modules' => [
        ...
        'triggers' => [
            'class' => 'triggers\lib\frameworks\yii\TriggersModule',
        ]
    ]
];
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
Базовая работа контроллера находится в `src\images\BaseController.php`. Оно использует `$triggersBoot::$config::SERVICES_LIST` для создания роутов и их загрузку. В контроллерах требуется создать публичный метод для возможности его вызова. За работу самого контроллера и возможности его вызова отвечате воркер `src\lib\ControllerWorker.php`, доступ к которому можно получить из `Boot::$controllers`.