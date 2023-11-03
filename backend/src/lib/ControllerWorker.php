<?php

namespace triggers\lib;

use triggers\images\BaseController;
use triggers\interfaces\ControllerWorkerInterface;

final class ControllerWorker extends BaseController implements ControllerWorkerInterface
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
    public function call($route, $bodyData = null, $queryData = null, $someRequest = null)
    {
        return $this->runMethod($route, $bodyData, $queryData, $someRequest);
    }

    /**
     * Список роутов
     *
     * @return array
     */
    public function getRouteList(): array
    {
        $routes = [];

        foreach ($this->getRoutes() as $baseRoute) {
            $routes[] = $baseRoute->getRealRoute();
        }

        return $routes;
    }

    /**
     * Список роутов
     *
     * @return BaseRoute[]
     */
    public function getRoutes(): array
    {
        return $this->routesList;
    }
}
