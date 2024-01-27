<?php

namespace triggers\lib\frameworks\yii;

use triggers\Config;
use triggers\Boot;
use triggers\images\BaseShellWorker;
use triggers\lib\BaseRoute;
use triggers\lib\frameworks\yii\models\AutomationRules;
use triggers\lib\frameworks\yii\models\TriggersActions;
use triggers\lib\frameworks\yii\models\TriggersHistory;

class ShellWorker extends BaseShellWorker
{
    protected function setShellName()
    {
        $this->shellName = Config::YII;
    }

    protected function setInstanceNamespace()
    {
        $this->instanceNamespace = 'Yii';
    }

    protected function registerControllers()
    {
        // ХЗ как сделать это для yii. Я не нашел методы, чтобы зарегистрировать роуты не создавая файлы контроллера

        /** @var BaseRoute */
        foreach ($this->controllers->getRoutes() as $baseRoute) {
            // $baseRoute->getRealRoute();
            // $baseRoute->call($bodyData, $queryData, $someRequest);
        }
    }

    protected function registerEvents()
    {
        \yii\base\Event::on(\yii\db\ActiveRecord::class, \yii\db\ActiveRecord::EVENT_AFTER_INSERT, [Boot::$service::$event, 'afterInsert']);
        \yii\base\Event::on(\yii\db\ActiveRecord::class, \yii\db\ActiveRecord::EVENT_AFTER_UPDATE, [Boot::$service::$event, 'afterUpdate']);
        \yii\base\Event::on(\yii\db\ActiveRecord::class, \yii\db\ActiveRecord::EVENT_BEFORE_DELETE, [Boot::$service::$event, 'beforeDelete']);
    }

    protected function registerModels()
    {
        $this->automationRulesModel = AutomationRules::class;
        $this->triggersActionsModel = TriggersActions::class;
        $this->triggersHistoryModel = TriggersHistory::class;
    }
}
