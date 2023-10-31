<?

namespace lobster\triggers;

use lobster\triggers\images\SomeModule;
use lobster\triggers\interfaces\ModuleWorkerInterface;

class ModuleWorker implements ModuleWorkerInterface
{

    public function loadFrameWorkShell(): SomeModule
    {
        $someModule = new SomeModule;
        return $someModule;
    }
}
