<?php

namespace triggers;

use triggers\images\ShellWorker;
use triggers\lib\frameworks\yii\ShellWorker as ShellWorkerYii;
use triggers\lib\frameworks\laravel\ShellWorker as ShellWorkerLaravel;
use triggers\lib\TriggerService;
use triggers\services\ActionsServiceController;
use triggers\services\DirectoriesServiceController;
use triggers\services\EntityServiceController;
use triggers\services\RulesServiceController;
use triggers\services\ViewServiceController;

final class Config
{
    const PHP_VERSION = PHP_VERSION_ID;

    /**
     * @var ShellWorker[]
     */
    const SHELL_LIST = [
        ShellWorkerYii::class,
        ShellWorkerLaravel::class,
    ];

    /**
     * Для реализации роутов решено использовать сервисы, в котором публичные
     * методы являются экшенами для работы роута.
     * Роут выглядит как {ROUTES_LIST[i]}/{ServiceService::<public_method>}
     * 
     * @var array
     */
    const ROUTES_LIST = [
        '' => ViewServiceController::class,
        'triggers/entities' => EntityServiceController::class,
        'triggers/directories' => DirectoriesServiceController::class,
        'triggers/actions' => ActionsServiceController::class,
        'triggers/rules' => RulesServiceController::class
    ];

    /**
     * Список сервисов доступных к использованию вне библиотеки
     */
    const SERVICES_LIST = [
        TriggerService::class
    ];

    const FRONTEND_VIEW_DIR = __DIR__ . '../../../frontend/dist/sakura-form/';
}
