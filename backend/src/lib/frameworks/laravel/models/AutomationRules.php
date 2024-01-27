<?php

namespace triggers\lib\frameworks\laravel\models;

use triggers\models\interfaces\AutomationRulesInterface;
use Eloquence\Behaviours\CamelCasing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasBoot;
use Illuminate\Database\Eloquent\SoftDeletes;

class AutomationRules extends Model implements AutomationRulesInterface
{
    use HasBoot, SoftDeletes, CamelCasing;

    public function getAuthor()
    {
        return null;
    }

    public function getAuthorId()
    {
        return null;
    }
}
