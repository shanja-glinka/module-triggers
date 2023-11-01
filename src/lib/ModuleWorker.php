<?

namespace lobster\triggers\lib;

use Exception;
use lobster\triggers\images\ShellLoader;
use lobster\triggers\interfaces\ModuleInterface;
use lobster\triggers\interfaces\ModuleWorkerInterface;

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
