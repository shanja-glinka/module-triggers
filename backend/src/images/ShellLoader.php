<?php

namespace triggers\images;

use Exception;
use triggers\Boot;

abstract class ShellLoader
{
    /**
     * @var BaseShellWorker 
     * */
    private $shell;


    /**
     * @return null
     */
    public function __invoke()
    {
        return $this->loadFrameWorkShell();
    }

    /**
     * @return BaseShellWorker|null
     */
    protected function getShell(): ?BaseShellWorker
    {
        return $this->shell;
    }

    /**
     * Из Boot::$config::SHELL_LIST создает обьект класса BaseShellWorker
     * в котором проверяется возможность получения оболочки
     * 
     * @return null
     */
    protected function loadFrameWorkShell()
    {

        if (!isset(Boot::$config)) {
            throw new Exception('Не удалось получить конфиг');
        }


        /** @var BaseShellWorker */
        foreach (Boot::$config::SHELL_LIST as $shellWorker) {
            $shellWorker = new $shellWorker;
            if ($shellWorker->isShellExists()) {
                $this->setShell($shellWorker);
                break;
            }
        }

        return $this->getShell();
    }

    /**
     * Происходит преобразование оболочки в модуль для Boot::$module
     * регистрации в требуемом фреймворке
     * 
     * 
     * @param BaseShellWorker $someShell
     * @return self
     */
    private function setShell(BaseShellWorker $someShell): self
    {
        $someShell->run();

        $this->shell = $someShell;

        return $this;
    }
}
