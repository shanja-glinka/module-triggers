<?php

namespace triggers\interfaces;

use triggers\lib\BaseRoute;

interface ControllerWorkerInterface
{
    /**
     * Шорткат BaseController::runMethod
     *
     * @param string $route
     * @param array $bodyData
     * @param array $queryData
     * @param mixed $someRequest
     * @return mixed
     */
    public function call($route, $bodyData = null, $queryData = null, $someRequest = null);

    /**
     * Список роутов
     *
     * @return array
     */
    public function getRouteList(): array;

    /**
     * Список роутов
     *
     * @return BaseRoute[]
     */
    public function getRoutes(): array;
}
