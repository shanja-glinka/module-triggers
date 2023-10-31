<?

namespace lobster\triggers;

use lobster\triggers\images\ShellWorker;
use lobster\triggers\lib\frameworks\yii\ShellWorker as ShellWorkerYii;
use lobster\triggers\lib\frameworks\laravel\ShellWorker as ShellWorkerLaravel;

final class Config
{
    const PHP_VERSION = PHP_VERSION_ID;

    /**
     * @var ShellWorker[]
     */
    const SHELL_LIST = [
        ShellWorkerYii::class,
        ShellWorkerLaravel::class,
    ];
}
