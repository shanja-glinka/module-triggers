<?php

namespace triggers\models\interfaces;

/**
 * @property int        $id                         [int(11)]
 * @property int        $trigger_id                 [int(11)]
 * @property string     $description                [text]
 * @property bool       $successful                 [tinyint(1)]
 * @property string     $entity_data                [text]
 * @property string     $run_date                   [datetime]
 * 
 * 
 * @property Triggers[] $triggers
 */
interface TriggersHistoryInterface
{
    public function getAuthorId();

    public function getTriggers();

    /**
     * Создает запись о срабатывании триггера
     *
     * @param int $triggerId
     * @param boolean $isSuccessful
     * @param mixed $startedWithData
     * @return boolean
     */
    public static function setTriggerFinished(int $triggerId, bool $isSuccessful, $startedWithData = null);
}
