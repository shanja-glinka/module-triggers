<?

namespace lobster\triggers;

use lobster\triggers\SomeModule;
use lobster\triggers\interfaces\ControllerInterface;
use lobster\triggers\interfaces\FactoryInterface;
use lobster\triggers\lib\ModuleWorker;

final class Factory implements FactoryInterface
{

    /** @var Config */
    public static $config;



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

        $moduleWorker->loadModule();
    }
}
