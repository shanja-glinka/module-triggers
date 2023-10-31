<?

namespace lobster\triggers\images;

use lobster\triggers\interfaces\ShellWorkerInterface;

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
        return !empty($this->getShellName()) && class_exists($this->getShellName());
    }


    protected abstract function setShellName();

    protected abstract function setInstanceNamespace();
}
