<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phonenumber',
        'message',
    ];
}
