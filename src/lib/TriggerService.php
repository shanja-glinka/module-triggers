<?php

namespace triggers\lib;

use triggers\interfaces\TriggerServiceInterface;

final class TriggerService implements TriggerServiceInterface
{
    /** @var Repository */
    public static $repository;

    /** @var TriggerEventService */
    public static $event;

    public function __construct()
    {
        $this->repository = new Repository;
    }

    /**
     * Функция срабатывания тригеров
     *
     * @param Triggers $triggersModel
     * @param mixed $attributes
     * @return void
     */
    public function triggerIt($triggersModel, $attributes)
    {
    }

    public function getModels()
    {
    }

    public function getSomeShit()
    {
    }
}
