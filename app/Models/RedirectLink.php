<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedirectLink extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shortlink_id',
        'ip',
        'user_agent',
        'query_data',
    ];

}