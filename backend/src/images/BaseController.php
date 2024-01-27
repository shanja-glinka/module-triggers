<?php

namespace triggers\images;

use Exception;
use triggers\Boot;
use triggers\lib\BaseRoute;

abstract class BaseController
{

    /** @var BaseRoute[] */
    protected $routesList;


    public function __construct()
    {
        $this->loadRoutes();
    }


    /**
     * Вызывает метод контроллера вместе с работой сервиса
     *
     * @param string $route
     * @param array $bodyData
     * @param array $queryData
     * @param mixed $someRequest
     * @return mixed
     */
    protected function runMethod(string $route, $bodyData = null, $queryData = null, $someRequest = null)
    {
        /** @var BaseRoute */
        foreach ($this->routesList as $baseRoute) {
            if ($baseRoute->getRealRoute() === $route) {
                return $baseRoute->call($bodyData, $queryData, $someRequest);
            }
        }

        throw new Exception('Роут не найден');
    }



    /**
     * Загружает активные роуты по методам из привязанных к нему сервисов
     *
     * @return void
     */
    private function loadRoutes(): void
    {
        $this->routesList = [];

        foreach (Boot::$config::ROUTES_LIST as $baseRoute => $serviceClass) {
            $this->createRoutes($baseRoute, $serviceClass);
        }
    }

    /**
     * Создает активный роут и сохраняет в общий список роутов
     *
     * @param string $baseRoute
     * @param string $serviceClass
     * @return void
     */
    private function createRoutes(string $baseRoute, string $serviceClass): void
    {
        foreach ($this->getPublicMethods($serviceClass) as $method) {
            $route = new BaseRoute;

            $route->baseRoute = $baseRoute;
            $route->service = $method->class;
            $route->method = $method->name;

            $this->routesList[] = $route;
        }
    }

    /**
     * Возвращает публичные методы исключая хуки
     *
     * @param string $className
     * @return array|null
     */
    private function getPublicMethods(string $className): ?array
    {
        try {
            return array_filter(
                (new \ReflectionClass($className))->getMethods(\ReflectionMethod::IS_PUBLIC),
                static function ($methods) {
                    return ($methods->name[0] . $methods->name[1] != '__');
                }
            );
        } catch (Exception $ex) {
            throw new Exception('Не удалось определить сервис: ' . $ex->getMessage());
        }
    }
}
