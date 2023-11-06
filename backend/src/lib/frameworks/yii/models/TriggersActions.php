<?php

namespace triggers\lib\frameworks\yii\models;

use triggers\models\interfaces\TriggersActionsInterface;

/**
 * @property int        $id                         [int(11)]
 * @property int        $trigger_id                 [int(11)]
 * @property string     $conditions                 [text]
 * @property string     $settings                   [text]
 * 
 * 
 * @property AutomationRules   $automationRules
 */
class TriggersActions extends \yii\db\ActiveRecord implements TriggersActionsInterface
{
    public static function tableName()
    {
        return 'triggers_actions';
    }

    public function rules()
    {
        return [
            [['trigger_id'], 'integer'],
            [['conditions', 'settings'], 'string'],
            [['trigger_id'], 'exist', 'skipOnError' => true, 'targetClass' => Triggers::class, 'targetAttribute' => ['trigger_id' => 'id'], 'message' => 'Триггре не найден']
        ];
    }

    public function getAutomationRules()
    {
        return $this->hasOne(AutomationRules::class, ['id' => 'trigger_id']);
    }

    public function triggerFinished(bool $isSuccessful, $startedWithData = null)
    {

        TriggersHistory::setTriggerFinished((int) $this->trigger_id, $isSuccessful, $startedWithData);

        $automationRules = $this->automationRules;
        if (!$automationRules) {
            $automationRules = $this->getTrigger();
        }

        $automationRules->setLastRun($isSuccessful);
    }
}
