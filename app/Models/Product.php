<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'detail', 'date', 'time',
    ];

    public function getCreatedAtAttribute($value)
    {
        $timezone = optional(auth()->user())->timezone ?? config('app.timezone');
        return Carbon::parse($value)->timezone($timezone);
    }
}
