<?php


require_once 'vendor/autoload.php';

use triggers\Factory;

// Для запуска в yii требуется прописать модуль в конфиг src\lib\frameworks\yii\Module.php
$factory = new Factory();
var_dump($factory::$controllers->getRouteList());
// $factory::$controllers->call('index');