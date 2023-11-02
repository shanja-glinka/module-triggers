<?php

namespace triggers\models\interfaces;

/**
 * @property int        $id                         [int(11)]
 * @property int        $trigger_id                 [int(11)]
 * @property string     $conditions                 [text]
 * @property string     $settings                   [text]
 * 
 * 
 * @property Triggers   $trigger
 */
interface TriggersActionsInterface
{
    public function getTrigger();

    /**
     * Выполняет логику запуска триггеров с сохранением истории срабатывания
     *
     * @param boolean $isSuccessful
     * @param mixed $startedWithData
     * @return void
     */
    public function triggerFinished(bool $isSuccessful, $startedWithData = null);
}
