<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exception extends Model
{
    protected $fillable = ['app_id', 'file', 'code', 'message', 'trace'];
}
