<?

namespace lobster\triggers;

use lobster\triggers\controllers\ActionsController;
use lobster\triggers\controllers\DirectoriesController;
use lobster\triggers\controllers\EntityController;
use lobster\triggers\controllers\RulesController;
use lobster\triggers\images\BaseController;
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
