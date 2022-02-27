<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'reasonn',
        'category',
        'min_quantity',
        'discount_quantity',
        'min_amount',
        'discount_rate'
    ];

    public function scopeGreaterThanMinAmount(Builder $query, $amount): Builder
    {
        return $query->where('min_amount', '<=', $amount);
    }
}
