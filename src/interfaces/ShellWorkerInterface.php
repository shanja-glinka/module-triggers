<?

namespace lobster\triggers\interfaces;

interface ShellWorkerInterface
{
    public function getShellName(): string;

    public function getInstanceNamespace(): string;
}
