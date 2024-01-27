<?php

namespace triggers\lib\frameworks\yii;

use triggers\Boot;
use triggers\lib\BaseRoute;
use yii\base\BootstrapInterface;

class TriggersModule extends \yii\base\Module implements BootstrapInterface
{

    public $controllerNamespace = 'triggers\lib\frameworks\yii\controllers';

    /**
     * Функция внутри переопределяет роуты для вызова перехвадчика 
     * 
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        $rules = [];
        $triggersBoot = new Boot;

        /** @var BaseRoute */
        foreach ($triggersBoot::$controllers->getRoutes() as $baseRoute) {
            $rules['/' . $baseRoute->getRealRoute()] = '/triggers/interceptor/intercept';
        }

        $app->getUrlManager()->addRules($rules);
    }

    public function init()
    {
        parent::init();
    }
}
