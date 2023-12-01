<?php

namespace triggers\lib\frameworks\yii\controllers;

use triggers\Factory;
use yii\web\Controller;

/**
 * Класс перехвадчик вызовов
 */
class InterceptorController extends Controller
{
    function beforeAction($action)
    {
        return true;
    }

    public function init()
    {
        parent::init();
    }

    /**
     * Хук для перехвата экшенов с вызовом требуемого экшена пакета
     *
     * @return void
     */
    public function actionIntercept()
    {
        return Factory::$controllers->call(
            \Yii::$app->request->getPathInfo(),
            \Yii::$app->request->getBodyParams(),
            \Yii::$app->request->getQueryParams()
        );
    }
}
