<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class ErrorLog extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $fillable = [
        'controller_name',
        'error_key',
        'user_id',
        'datas',
        'result',
        'model',
        'ip'
    ];

}