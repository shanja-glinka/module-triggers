<?php

namespace triggers\lib;

use triggers\Factory;
use triggers\models\interfaces\TriggersInterface;

final class TriggerEventService
{

    /**
     * Ссылка на репозиторий
     *  
     * @var Repository 
     * */
    private $repository;


    public function __construct()
    {
        $this->repository = Factory::$service::$repository;
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
     * @param ShellEventData $eventData
     * @param boolean $isInsert
     * @param boolean $isUpdate
     * @param boolean $isDelete
     * @return void
     */
    private function tryToTriggerIt(ShellEventData $eventData, bool $isInsert = false, bool $isUpdate = false, $isDelete = false)
    {
        /** @var TriggersInterface */

        $triggersModel = $this->repository->findOneTriggerBy([
            'entity_type' => $this->repository->normalizeTableName($eventData->tableName),
            'on_insert' => $isInsert,
            'on_update' => $isUpdate,
            'on_delete' => $isDelete,
            'is_active' => true
        ]);

        if ($triggersModel) {
            Factory::$service->triggerIt($triggersModel, $eventData->attributes);
        }
    }

    /**
     * Обработчик значения, что пришел как аргумент функции события
     *
     * @param mixed $someEvent
     * @return ShellEventData|null
     */
    private function translateShellEvent($someEvent): ?ShellEventData
    {
        $shellEventData = new ShellEventData;

        $shellEventData->tableName = '';
        $shellEventData->attributes = null;

        switch (Factory::$shellName) {
            case 'yii':
                $sender = $someEvent->sender;

                $shellEventData->tableName = $sender->tableName();
                $shellEventData->attributes = $sender->toArray();

                return $shellEventData;
            case 'laravel':
                return null;
            default:
                return null;
        }
    }
}
