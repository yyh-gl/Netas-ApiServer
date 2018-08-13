<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Tag extends BaseModel
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'followed_count',
    ];
}
