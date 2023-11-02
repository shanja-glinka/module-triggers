<?php

namespace triggers\interfaces;

use triggers\lib\ControllerWorker;

interface ModuleWorkerInterface
{
    /**
     * Загрузка оболочки, для регистрации роутов и хуков 
     *
     * @return void
     */
    public function loadModule(): void;

    /**
     * Возвращает базовый контроллер для статичного использования
     *
     * @return ControllerWorker
     */
    public function getControllers(): ControllerWorker;

    /**
     * Название запущенной оболочки
     *
     * @return string
     */
    public function getShellName(): string;

    /**
     * @return object
     */
    public function getModels();
}
