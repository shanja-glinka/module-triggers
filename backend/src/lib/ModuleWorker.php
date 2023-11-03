<?php

namespace triggers\lib;

use Exception;
use triggers\images\ShellLoader;
use triggers\interfaces\ModuleWorkerInterface;

class ModuleWorker extends ShellLoader implements ModuleWorkerInterface
{

    /**
     * Загрузка оболочки, для регистрации роутов и хуков 
     *
     * @return void
     */
    public function loadModule(): void
    {
        $this->loadFrameworkShell();

        if (empty($this->getShell())) {
            throw new Exception('Неудалось определить оболочку фреймворка');
        }
    }

    /**
     * Возвращает базовый контроллер для статичного использования
     *
     * @return ControllerWorker
     */
    public function getControllers(): ControllerWorker
    {
        return $this->getShell()->getControllers();
    }

    /**
     * Название запущенной оболочки
     *
     * @return string
     */
    public function getShellName(): string
    {
        return $this->getShell()->getShellName();
    }


    /**
     * @return object
     */
    public function getModels()
    {
        return $this->getShell()->getModels();
    }
    
}
