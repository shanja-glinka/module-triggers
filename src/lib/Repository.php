<?php

namespace triggers\lib;

use triggers\images\BaseServiceAdapter;

final class Repository extends BaseServiceAdapter
{
    public function findOneTriggerBy(array $condition)
    {
        return $this->triggersModel::findOne($condition);
    }


    /**
     * Нормализует таблицу удаляя левые символы, что могу встретится в таблицах моделей
     *
     * @param string $tableName
     * @return string
     */
    public function normalizeTableName(string $tableName): string
    {
        return str_replace('{', '', str_replace('}', '', str_replace('%', '', $tableName)));
    }
}
