<?

namespace triggers\images;

use triggers\interfaces\ShellWorkerInterface;

abstract class ShellWorker implements ShellWorkerInterface
{
    /** @var string */
    protected $shellName;

    /** @var string */
    protected $instanceNamespace;


    public function __construct()
    {
        $this->setShellName();
        $this->setInstanceNamespace();
    }


    public function run(): void
    {
        $this->registerControllers();
        $this->registerEvents();
    }


    public function getShellName(): string
    {
        return $this->shellName;
    }

    public function getInstanceNamespace(): string
    {
        return $this->instanceNamespace;
    }

    public function isShellExists(): bool
    {
        return !empty($this->getInstanceNamespace()) && class_exists($this->getInstanceNamespace());
    }


    protected abstract function setShellName();

    protected abstract function setInstanceNamespace();

    protected abstract function registerControllers();

    protected abstract function registerEvents();
}
