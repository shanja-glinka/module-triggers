<?

namespace lobster\triggers\lib\frameworks\yii;

use lobster\triggers\images\ShellWorker as BaseInterShellWorker;

class ShellWorker extends BaseInterShellWorker
{
    protected function setShellName()
    {
        $this->shellName = 'Yii';
    }

    protected function setInstanceNamespace()
    {
        $this->instanceNamespace = 'Yii';
    }

    protected function registerControllers()
    {
    }

    protected function registerEvents()
    {
    }
}
