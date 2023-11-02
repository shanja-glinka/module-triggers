<?php

namespace triggers\lib\frameworks\yii\models;

use backend\models\User;
use Exception;
use triggers\models\interfaces\TriggersInterface;

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
class Triggers extends \yii\db\ActiveRecord implements TriggersInterface
{
    public static function tableName()
    {
        return 'triggers';
    }

    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['name', 'description', 'entity_type', 'additional_settings', 'conditions_settings'], 'string'],
            [['name'], 'string', 'max' => 60],
            [['entity_type'], 'string', 'max' => 90],
            [['on_update', 'on_create', 'on_delete', 'is_active'], 'boolean'],
            [['created_date', 'updated_date', 'deleted_date', 'last_run_date', 'last_success_run_date'], 'datetime', 'format' => 'php:Y-m-d H:i:s', 'allowEmpty' => true],
        ];
    }

    public function beforeSave($isInsert)
    {
        throw new Exception('Пропиши правила для создания времени обновления и удаления тьриггеров');

        return parent::beforeSave($isInsert);
    }

    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    public function setLastRun(bool $isSuccessful)
    {
        $this->last_run_date = date('Y-m-d H:i:s');

        if ($isSuccessful) {
            $this->last_success_run_date = $this->last_run_date;
        }

        $this->save(false);
    }
}
