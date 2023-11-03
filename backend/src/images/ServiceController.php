<?php

namespace triggers\images;

abstract class ServiceController
{
    /**
     * Данные POST тела
     *
     * @var array
     */
    protected $bodyData;

    /**
     * Данные GET тела
     *
     * @var array
     */
    protected $queryData;


    /**
     * Какие-то данные
     *
     * @var array
     */
    protected $someRequest;


    /**
     * Метод инициализирующий получение запуск метода роута
     *
     * @param array $bodyData
     * @param array $queryData
     * @param mixed $someRequest
     */
    public function __construct($bodyData = null, $queryData = null, $someRequest = null)
    {
        $this
            ->setBodyData($bodyData)
            ->setQueryData($queryData)
            ->setSomeRequest($someRequest);
    }

    /**
     * @param mixed $bodyData
     * @return self
     */
    private function setBodyData($bodyData): self
    {
        $this->bodyData = $this->someToArray($bodyData);

        return $this;
    }

    /**
     * @param mixed $queryData
     * @return self
     */
    private function setQueryData($queryData): self
    {
        $this->queryData = $this->someToArray($queryData);

        return $this;
    }

    /**
     * @param mixed $bodyData
     * @return self
     */
    private function setSomeRequest($someRequest): self
    {
        $this->someRequest = $someRequest;

        return $this;
    }


    /**
     * Преобразовывает чтото в массив
     *
     * @param mixed $someData
     * @return array
     */
    private function someToArray($someData): array
    {

        if (is_object($someData)) {
            $someData = @json_encode($someData);
        }

        if (is_string($someData)) {
            $someData = @json_decode($someData, true);
        }

        if (empty($someData)) {
            $someData = [];
        }

        if (!is_array($someData)) {
            $someData = [$someData];
        }

        return $someData;
    }
}
