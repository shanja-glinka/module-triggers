<?php

namespace triggers\lib\frameworks\laravel;

use triggers\Factory;
use triggers\images\BaseShellWorker;
use triggers\lib\frameworks\laravel\models\Triggers;
use triggers\lib\frameworks\laravel\models\TriggersActions;
use triggers\lib\frameworks\laravel\models\TriggersHistory;

class ShellWorker extends BaseShellWorker
{
    protected function setShellName()
    {
        $this->shellName = 'laravel';
    }

    protected function setInstanceNamespace()
    {
        $this->instanceNamespace = 'Illuminate\Foundation\Application';
    }

    protected function registerControllers()
    {
        /** @var BaseRoute */
        foreach ($this->controllers->getRoutes() as $baseRoute) {
            // $baseRoute->getRealRoute();
            // $baseRoute->call($bodyData, $queryData, $someRequest);
        }
    }

    protected function registerEvents()
    {
        \Illuminate\Support\Facades\Event::listen('eloquent.created: *', function ($event) {
            Factory::$service::$event->afterInsert($event);
        });
        \Illuminate\Support\Facades\Event::listen('eloquent.saved: *', function ($event) {
            Factory::$service::$event->afterUpdate($event);
        });
        \Illuminate\Support\Facades\Event::listen('eloquent.deleted: *', function ($event) {
            Factory::$service::$event->beforeDelete($event);
        });
    }

    protected function registerModels()
    {
        $this->triggersModel = Triggers::class;
        $this->triggersActionsModel = TriggersActions::class;
        $this->triggersHistoryModel = TriggersHistory::class;
    }
}
