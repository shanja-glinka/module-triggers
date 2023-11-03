<?php

namespace triggers\lib;

use RuntimeException;
use triggers\interfaces\BaseRouteInterface;

class BaseRoute implements BaseRouteInterface
{
    /**
     * Методы, что принимает роут
     *  
     * @var array 
     * */
    public $methods = [];

    /** 
     * Основной роут для сервиса
     * 
     * @var string 
     * */
    public $baseRoute;

    /** 
     * Ссылка на класс сервиса, что будет обслуживать роут, публичные
     * методы которого являются конечными роутами
     * 
     * @var mixed 
     * */
    public $service;

    /** 
     * Метод что будет вызван из $service
     * 
     * @var mixed 
     * */
    public $method;



    /**
     * Возвращает нормализованный путь роута преобразовывая в нормальную ссылку.
     * Пример: routePath/MethodName
     *
     * @return string
     */
    public function getRealRoute(): string
    {
        $methods = $this->method;

        if (!empty($methods)) {
            $methods = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $methods));
        }

        return ($this->baseRoute ?? '') . '/' . $methods;
    }

    /**
     * Запускает сервис и вызывает метод
     *
     * @param array $bodyData
     * @param array $queryData
     * @param mixed $someRequest
     * @return mixed
     */
    public function call($bodyData = null, $queryData = null, $someRequest = null)
    {
        if (empty($this->service) || !class_exists($this->service)) {
            throw new RuntimeException('Сервис "' . $this->service . '" не найден. Вызов метода "' . $this->method . '" невозможен');
        }
        if (!method_exists($this->service, $this->method)) {
            throw new RuntimeException('Сервис "' . $this->service . '" не найден. Вызов метода "' . $this->method . '" невозможен');
        }

        $reflection = new \ReflectionClass($this->service);

        $someService = $reflection->newInstanceArgs([$bodyData, $queryData, $someRequest]);
        return $someService->{$this->method}();
    }
}
