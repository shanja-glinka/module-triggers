<?php

namespace triggers\images;

use triggers\Factory;

/**
 * Включает в себя классы моделей
 */
abstract class BaseServiceAdapter
{
    /** @var TriggersInterface */
    public $automationRulesModel;

    /** @var TriggersActionsInterface */
    protected $triggersActionsModel;

    /** @var TriggersHistoryInterface */
    protected $triggersHistoryModel;


    public function initModels()
    {
        $this->automationRulesModel = Factory::$models->automationRules;
        $this->triggersActionsModel = Factory::$models->triggersActions;
        $this->triggersHistoryModel = Factory::$models->triggersHistory;
    }
}
