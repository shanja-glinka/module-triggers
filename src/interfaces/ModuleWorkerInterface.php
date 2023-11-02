<?php

namespace triggers\interfaces;

interface ModuleWorkerInterface
{
    public function loadModule(): ModuleInterface;
}
