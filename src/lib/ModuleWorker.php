<?

namespace triggers\lib;

use Exception;
use triggers\images\ShellLoader;
use triggers\interfaces\ModuleInterface;
use triggers\interfaces\ModuleWorkerInterface;

class ModuleWorker extends ShellLoader implements ModuleWorkerInterface
{

    public function loadModule(): ModuleInterface
    {
        $this->detectShell();

        if (empty($this->getShell())) {
            throw new Exception('Неудалось определить оболочку фреймворка');
        }

        return $this->getShell();
    }

    private function detectShell(): void
    {
        $this->loadFrameworkShell();
    }
}
