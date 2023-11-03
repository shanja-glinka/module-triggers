<?php

namespace triggers\images;

use triggers\Factory;

/**
 * Включает в себя классы моделей
 */
abstract class BaseServiceAdapter
{
    /** @var TriggersInterface */
    public $triggersModel;

    /** @var TriggersActionsInterface */
    protected $triggersActionsModel;

    /** @var TriggersHistoryInterface */
    protected $triggersHistoryModel;


    public function initModels()
    {
        $this->triggersModel = Factory::$models->triggers;
        $this->triggersActionsModel = Factory::$models->triggersActions;
        $this->triggersHistoryModel = Factory::$models->triggersHistory;
    }
}
