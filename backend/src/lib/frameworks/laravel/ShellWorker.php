<?php

namespace triggers\lib\frameworks\laravel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use triggers\Config;
use triggers\Factory;
use triggers\images\BaseShellWorker;
use triggers\lib\frameworks\laravel\models\AutomationRules;
use triggers\lib\frameworks\laravel\models\TriggersActions;
use triggers\lib\frameworks\laravel\models\TriggersHistory;
use Illuminate\Support\Facades\Route;


class ShellWorker extends BaseShellWorker
{
    protected function setShellName()
    {
        $this->shellName = Config::LARAVEL;
    }

    protected function setInstanceNamespace()
    {
        $this->instanceNamespace = 'Illuminate\Foundation\Application';
    }

    protected function registerControllers()
    {
        /** @var BaseRoute */
        foreach ($this->controllers->getRoutes() as $baseRoute) {
            $methods = $baseRoute->getMethods();
            foreach ($methods as $method){
               if( $baseRoute->baseRoute === "" ) continue;

                Route::$method("$baseRoute->baseRoute/$baseRoute->method", function (Request $request) use ($baseRoute){
                    return $baseRoute->call(null, null, $request->all());
                } );
            }
        }
    }

    protected function registerEvents()
    {
        \Illuminate\Support\Facades\Event::listen('eloquent.created: *', function ($event,  $data) {
            Factory::$service::$event->afterInsert($event);
        });
        \Illuminate\Support\Facades\Event::listen('eloquent.saved: *', function ($event, $data) {
            Factory::$service::$event->afterUpdate($event);
        });
        \Illuminate\Support\Facades\Event::listen('eloquent.deleted: *', function ($event, $data) {
            Factory::$service::$event->beforeDelete($event);
        });
    }

    protected function registerModels()
    {
        $this->automationRulesModel = AutomationRules::class;
        $this->triggersActionsModel = TriggersActions::class;
        $this->triggersHistoryModel = TriggersHistory::class;
    }
}
