<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedirectBadLink extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shortlink',
        'ip',
        'user_agent',
        'query_data',
    ];

}