<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public static function getRecordById(int $id)
    {
        return (new static)->newQuery()
            ->where('id', $id)
            ->first();
    }
}