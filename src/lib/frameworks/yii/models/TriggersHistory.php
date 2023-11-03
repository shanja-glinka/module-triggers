<?php

namespace triggers\models;

namespace triggers\lib\frameworks\yii\models;

use triggers\models\interfaces\TriggersHistoryInterface;

/**
 * @property int        $id                         [int(11)]
 * @property int        $trigger_id                 [int(11)]
 * @property string     $description                [text]
 * @property bool       $successful                 [tinyint(1)]
 * @property string     $entity_data                [text]
 * @property string     $run_date                   [datetime]
 * 
 * 
 * @property Trigger[]  $triggers
 */
class TriggersHistory extends \yii\db\ActiveRecord implements TriggersHistoryInterface
{
    public static function tableName()
    {
        return 'triggers_history';
    }

    public function rules()
    {
        return [
            [['trigger_id'], 'integer'],
            [['description', 'entity_data'], 'string'],
            [['successful'], 'boolean'],
            [['run_date'], 'datetime', 'format' => 'php:Y-m-d H:i:s', 'allowEmpty' => true],
            [['trigger_id'], 'exist', 'skipOnError' => true, 'targetClass' => Triggers::class, 'targetAttribute' => ['trigger_id' => 'id'], 'message' => 'Триггре не найден']
        ];
    }

    public function getAuthorId()
    {
        return \Yii::$app->user->getId();
    }

    public function getTriggers()
    {
        return $this->hasMany(Triggers::class, ['id' => 'trigger_id']);
    }

    public static function setTriggerFinished(int $triggerId, bool $isSuccessful, $startedWithData = null)
    {
        $newdata = new self;

        $newdata->trigger_id = $triggerId;
        $newdata->successful = $isSuccessful;
        $newdata->run_date = date('Y-m-d H:i:s');
        $newdata->entity_data = @json_encode($startedWithData);

        $newdata->save(false);
    }
}
