<?php

namespace triggers\interfaces;

interface BaseRouteInterface
{

    /**
     * Возвращает нормализованный путь роута преобразовывая в нормальную ссылку.
     * Пример: routePath/MethodName
     *
     * @return string
     */
    public function getRealRoute(): string;

    /**
     * Запускает сервис и вызывает метод
     *
     * @param array $bodyData
     * @param array $queryData
     * @param mixed $someRequest
     * @return mixed
     */
    public function call($bodyData = null, $queryData = null, $someRequest = null);
}
