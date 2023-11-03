<?php

namespace triggers\models\interfaces;

/**
 * @property int        $id                         [int(11)]
 * @property string     $name                       [varchar(60)]
 * @property string     $description                [text]
 * @property string     $entity_type                [varchar(90)]
 * @property bool       $on_update                  [tinyint(1)]
 * @property bool       $on_create                  [tinyint(1)]
 * @property bool       $on_delete                  [tinyint(1)]
 * @property bool       $is_active                  [tinyint(1)] 
 * @property string     $additional_settings        [text]
 * @property string     $conditions_settings        [text]
 * @property int        $author_id                  [int(11)]
 * @property string     $created_date               [datetime]
 * @property string     $updated_date               [datetime]
 * @property string     $deleted_date               [datetime]
 * @property string     $last_run_date              [datetime]
 * @property string     $last_success_run_date      [datetime]
 * 
 * 
 * @property User       $author
 */
interface TriggersInterface
{
    public function getAuthor();

    /**
     * Обновляет последнее время срабатывание триггера
     *
     * @param boolean $isSuccessful
     * @return void
     */
    public function setLastRun(bool $isSuccessful);
}
