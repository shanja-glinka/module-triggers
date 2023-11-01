<?

namespace lobster\triggers\lib\frameworks\laravel;

use lobster\triggers\images\ShellWorker as BaseInterShellWorker;

class ShellWorker extends BaseInterShellWorker
{
    protected function setShellName()
    {
        $this->shellName = 'Laravel';
    }

    protected function setInstanceNamespace()
    {
        $this->instanceNamespace = 'Illuminate\Foundation\Application';
    }

    protected function registerControllers()
    {
    }

    protected function registerEvents()
    {
    }
}
