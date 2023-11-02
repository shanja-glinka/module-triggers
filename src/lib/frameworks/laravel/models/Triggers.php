<?php

namespace triggers\lib\frameworks\laravel\models;

use triggers\models\interfaces\TriggersInterface;
use Eloquence\Behaviours\CamelCasing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Triggers extends Model implements TriggersInterface
{
    use HasFactory, SoftDeletes, CamelCasing;

    public function getAuthor()
    {
        return null;
    }

    public function getAuthorId()
    {
        return null;
    }
}
