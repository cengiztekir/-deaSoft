<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $fillable = [
        'controller_name',
        'user_id',
        'datas',
        'filters',
        'result',
        'model',
        'ip'
    ];

}