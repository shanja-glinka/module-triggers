<?php

namespace triggers\images;

use triggers\Boot;

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
        $this->automationRulesModel = Boot::$models->automationRules;
        $this->triggersActionsModel = Boot::$models->triggersActions;
        $this->triggersHistoryModel = Boot::$models->triggersHistory;
    }
}
