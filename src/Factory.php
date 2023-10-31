<?

namespace lobster\triggers;

use lobster\triggers\images\SomeModule;
use lobster\triggers\interfaces\ControllerInterface;
use lobster\triggers\interfaces\FactoryInterface;

final class Factory implements FactoryInterface
{

    /** @var Config */
    public static $config;

    /** @var SomeModule */
    public static $module;



    /** @var ControllerInterface */
    public static $controller;

    /** @var Services[] */
    public static $trigger;

    /** @var Services[] */
    public static $services;



    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        $this->setConfig();

        $this->detectInstance();
    }

    private function setConfig()
    {
        self::$config = new Config();
    }

    private function detectInstance()
    {
        $moduleWorker = new ModuleWorker();
        self::$module = $moduleWorker->loadFrameWorkShell();
    }
}
