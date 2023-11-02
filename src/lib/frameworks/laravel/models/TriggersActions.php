<?php

namespace triggers\lib\frameworks\laravel\models;

use triggers\models\interfaces\TriggersActionsInterface;
use Eloquence\Behaviours\CamelCasing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TriggersActions extends Model implements TriggersActionsInterface
{
    use HasFactory, SoftDeletes, CamelCasing;

    public function getTrigger()
    {
        return null;
    }
}
