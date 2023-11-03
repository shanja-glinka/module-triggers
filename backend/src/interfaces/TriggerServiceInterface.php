<?php

namespace triggers\interfaces;

interface TriggerServiceInterface
{

    /**
     * Функция срабатывания тригеров
     *
     * @param Triggers $triggersModel
     * @param mixed $attributes
     * @return void
     */
    public function triggerIt($triggersModel, $attributes);
}
