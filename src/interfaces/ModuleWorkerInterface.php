<?

namespace lobster\triggers\interfaces;

use lobster\triggers\images\SomeModule;

interface ModuleWorkerInterface
{
    public function loadFrameWorkShell(): SomeModule;
}
