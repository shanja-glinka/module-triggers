<?

namespace triggers\interfaces;

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
}
