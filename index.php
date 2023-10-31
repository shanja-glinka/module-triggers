<?php


require_once 'vendor/autoload.php';

use lobster\triggers\Factory;
use lobster\triggers\Module;

$triggers = new Module();
$factory = new Factory();


$module = $factory::$module;