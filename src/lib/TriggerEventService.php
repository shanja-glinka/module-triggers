<?php

namespace triggers\lib;

use triggers\Factory;
use triggers\models\interfaces\TriggersInterface;

final class TriggerEventService
{

    public function __construct()
    {
    }

    public function afterInsert($someEvent)
    {
        $data = $this->translateShellEvent($someEvent);

        if (empty($tableName)) {
            return;
        }

        $this->tryToTriggerIt($data, true);
    }

    public function afterUpdate($someEvent)
    {
        $data = $this->translateShellEvent($someEvent);

        if (empty($tableName)) {
            return;
        }

        $this->tryToTriggerIt($data, false, true);
    }

    public function beforeDelete($someEvent)
    {
        $data = $this->translateShellEvent($someEvent);

        if (empty($tableName)) {
            return;
        }

        $this->tryToTriggerIt($data, false, false, true);
    }



    /**
     * Функция поиска с последующим вызовом триггера
     *
     * @param object $eventData
     * @param boolean $isInsert
     * @param boolean $isUpdate
     * @param boolean $isDelete
     * @return void
     */
    private function tryToTriggerIt($eventData, bool $isInsert = false, bool $isUpdate = false, $isDelete = false)
    {
        /** @var TriggersInterface */

        $triggersModel = Factory::$models->triggers::findOne([
            'entity_type' => $this->normalizeTableName($eventData->tableName),
            'on_insert' => $isInsert,
            'on_update' => $isUpdate,
            'on_delete' => $isDelete,
            'is_active' => true
        ]);

        if ($triggersModel) {
            Factory::$service->triggerIt($triggersModel, $eventData->attributes);
        }
    }


    private function normalizeTableName(string $tableName): string
    {
        return str_replace('{', '', str_replace('}', '', str_replace('%', '', $tableName)));
    }

    /**
     * Обработчик значения, что пришел как аргумент функции события
     *
     * @param mixed $someEvent
     * @return \stdClass|null
     */
    private function translateShellEvent($someEvent): ?\stdClass
    {
        $data = new \stdClass;

        $data->tableName = '';
        $data->attributes = '';

        switch (Factory::$shellName) {
            case 'yii':
                $sender = $someEvent->sender;

                $data->tableName = $sender->tableName();
                $data->attributes = $sender->toArray();

                return $data;
            case 'laravel':
                return null;
            default:
                return null;
        }
    }
}
