<?php

namespace triggers\interfaces;

use triggers\lib\ControllerWorker;

interface ShellWorkerInterface
{
    /**
     * Инициация регистрации модуля и контроллеров библиотеки триггеров
     *
     * @return void
     */
    public function run(): void;

    /**
     * Требуется для инициализации оболочки
     *
     * @return string
     */
    public function getShellName(): string;

    /**
     * Требуется для инициализации оболочки
     *
     * @return string
     */
    public function getInstanceNamespace(): string;

    /**
     * Функиця проверки существования оболочки фреймворка
     *
     * @return boolean
     */
    public function isShellExists(): bool;

    /**
     * @return ControllerWorker
     */
    public function getControllers(): ControllerWorker;

    /**
     * @return stdClass
     */
    public function getModels();
}
