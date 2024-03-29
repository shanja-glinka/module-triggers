<?php

namespace triggers;

use triggers\interfaces\BootInterface;
use triggers\lib\ControllerWorker;
use triggers\lib\ModuleWorker;
use triggers\lib\TriggerEventService;
use triggers\lib\TriggerService;

final class Boot implements BootInterface
{

    /** @var Config */
    public static $config;

    /** @var ControllerWorker */
    public static $controllers;

    /** @var string */
    public static $shellName;

    /** @var object */
    public static $models;

    /** @var TriggerService */
    public static $service;


    public function __construct()
    {
        $this->init();
    }


    private function init()
    {
        $this->setConfig();

        $this->setMainService();

        $this->detectInstance();

        return $this;
    }

    private function setConfig()
    {
        self::$config = new Config();
    }

    private function setMainService()
    {
        self::$service = new TriggerService();
        self::$service::$event = new TriggerEventService();
    }

    private function detectInstance()
    {
        $modeWorker = new ModuleWorker();
        $modeWorker->loadModule();

        self::$controllers = $modeWorker->getControllers();
        self::$shellName = $modeWorker->getShellName();

        self::$models = $modeWorker->getModels();

        self::$service::$repository->initModels();
    }
}
