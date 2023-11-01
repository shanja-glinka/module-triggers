<?

namespace lobster\triggers\images;

use Exception;
use lobster\triggers\Factory;
use lobster\triggers\interfaces\ModuleInterface;
use lobster\triggers\SomeModule;

abstract class ShellLoader
{
    /** @var ModuleInterface */
    private $shell;


    /**
     * @return ModuleInterface|null
     */
    public function __invoke(): ?ModuleInterface
    {
        return $this->loadFrameWorkShell();
    }

    /**
     * @return ModuleInterface|null
     */
    protected function getShell(): ?ModuleInterface
    {
        return $this->shell;
    }

    /**
     * Происходит преобразование оболочки в модуль для Factory::$module
     * регистрации в требуемом фреймворке
     * 
     * 
     * @param ShellWorker $someShell
     * @return self
     */
    private function setShell(ShellWorker $someShell): self
    {

        $someShell->run();

        $this->shell = new SomeModule;
        var_dump($someShell);
        return $this;
    }

    /**
     * Из Factory::$config::SHELL_LIST создает обьект класса ShellWorker
     * в котором проверяется возможность получения оболочки
     * 
     * @return ModuleInterface|null
     */
    protected function loadFrameWorkShell(): ?ModuleInterface
    {

        if (!isset(Factory::$config)) {
            throw new Exception('Не удалось получить конфиг');
        }


        /** @var ShellWorker */
        foreach (Factory::$config::SHELL_LIST as $shellWorker) {
            $shellWorker = new $shellWorker;
            if ($shellWorker->isShellExists()) {
                $this->setShell($shellWorker);
                break;
            }
        }

        // for example
        $shellWorker = Factory::$config::SHELL_LIST[0];
        $this->setShell(new $shellWorker);

        return $this->getShell();
    }
}
