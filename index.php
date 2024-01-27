<?php


require_once 'vendor/autoload.php';

use triggers\Boot;

// Для запуска в yii требуется прописать модуль в конфиг src\lib\frameworks\yii\Module.php
$boot = new Boot();
var_dump($boot::$controllers->getRouteList());
// $boot::$controllers->call('index');