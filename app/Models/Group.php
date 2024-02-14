<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    public $table = 'groups';

    public function fetch()
    {
        return self::get();
    }

    public function listGroupsName()
    {
        return self::pluck('name', 'id')->toArray();
    }

}
