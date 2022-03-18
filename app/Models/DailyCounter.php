<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyCounter extends Model
{
    use HasFactory;
    protected $table = 'daily_counter';
    protected $attributes = [
        'current_date'=> '',
        'counter'=>0,
    ];
    public $timestamps = false;
}
