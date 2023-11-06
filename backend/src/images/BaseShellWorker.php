<?php

namespace triggers\images;

use triggers\interfaces\ShellWorkerInterface;
use triggers\lib\ControllerWorker;
use triggers\models\interfaces\TriggersActionsInterface;
use triggers\models\interfaces\TriggersHistoryInterface;
use triggers\models\interfaces\TriggersInterface;

abstract class BaseShellWorker implements ShellWorkerInterface
{

    /** @var string */
    protected $shellName;

    /** @var string */
    protected $instanceNamespace;

    /** @var ControllerWorker */
    protected $controllers;

    /** @var TriggersInterface */
    protected $automationRulesModel;

    /** @var TriggersActionsInterface */
    protected $triggersActionsModel;

    /** @var TriggersHistoryInterface */
    protected $triggersHistoryModel;


    public function __construct()
    {
        $this->setShellName();
        $this->setInstanceNamespace();
        $this->prepareControllers();
    }

    /**
     * Инициация регистрации модуля и контроллеров библиотеки триггеров
     *
     * @return void
     */
    public function run(): void
    {
        $this->registerControllers();
        $this->registerEvents();
        $this->registerModels();
    }

    /**
     * Требуется для инициализации оболочки
     *
     * @return string
     */
    public function getShellName(): string
    {
        return $this->shellName;
    }

    /**
     * Требуется для инициализации оболочки
     *
     * @return string
     */
    public function getInstanceNamespace(): string
    {
        return $this->instanceNamespace;
    }

    /**
     * Функиця проверки существования оболочки фреймворка
     *
     * @return boolean
     */
    public function isShellExists(): bool
    {
        return !empty($this->getInstanceNamespace()) && class_exists($this->getInstanceNamespace());
    }

    /**
     * @return ControllerWorker
     */
    public function getControllers(): ControllerWorker
    {
        return $this->controllers;
    }

    /**
     * @return stdClass
     */
    public function getModels()
    {
        $obj = new \stdClass;

        $obj->automationRules = $this->automationRulesModel;
        $obj->triggersActions = $this->triggersActionsModel;
        $obj->triggersHistory = $this->triggersHistoryModel;

        return $obj;
    }


    protected abstract function setShellName();

    protected abstract function setInstanceNamespace();

    protected abstract function registerControllers();

    protected abstract function registerEvents();

    protected abstract function registerModels();


    private function prepareControllers()
    {
        $this->controllers = new ControllerWorker();
    }
}
