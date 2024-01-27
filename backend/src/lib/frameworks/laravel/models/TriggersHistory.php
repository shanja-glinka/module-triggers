<?php

namespace triggers\models;

namespace triggers\lib\frameworks\laravel\models;

use triggers\models\interfaces\TriggersHistoryInterface;
use Eloquence\Behaviours\CamelCasing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasBoot;
use Illuminate\Database\Eloquent\SoftDeletes;

class TriggersHistory extends Model implements TriggersHistoryInterface
{
    use HasBoot, SoftDeletes, CamelCasing;

    public function getTriggers()
    {
        return null;
    }
}
