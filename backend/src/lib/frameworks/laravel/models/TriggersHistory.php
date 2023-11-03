<?php

namespace triggers\models;

namespace triggers\lib\frameworks\laravel\models;

use triggers\models\interfaces\TriggersHistoryInterface;
use Eloquence\Behaviours\CamelCasing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TriggersHistory extends Model implements TriggersHistoryInterface
{
    use HasFactory, SoftDeletes, CamelCasing;

    public function getTriggers()
    {
        return null;
    }
}
