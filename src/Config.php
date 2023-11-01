<?

namespace lobster\triggers;

use triggers\controllers\ActionsController;
use triggers\controllers\DirectoriesController;
use triggers\controllers\EntityController;
use triggers\controllers\RulesController;
use triggers\images\BaseController;
use triggers\images\ShellWorker;
use triggers\lib\frameworks\yii\ShellWorker as ShellWorkerYii;
use triggers\lib\frameworks\laravel\ShellWorker as ShellWorkerLaravel;

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

    /**
     * @var BaseController[]
     */
    const ROUTES_LIST = [
        'triggers/entities' => EntityController::class,
        'triggers/directories' => DirectoriesController::class,
        'triggers/actions' => ActionsController::class,
        'triggers/rules' => RulesController::class
    ];
}
