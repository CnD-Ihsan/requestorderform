<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ROF extends Model
{
    use HasFactory;
    protected $table = 'rof';
    protected $attributes = [
        'approved_at'=>null,
        'approved_by'=>'',
        'received_by'=>'',
        'received_at'=>null
    ];
    public $timestamps = false;

    protected $guarded = [
        'id',
    ];

    public function rofItems(){
        return $this->hasMany(ROF_Item::class, 'form_ref_no');
    }

    public function user(){
        return $this->belongsTo(User::class, 'requested_by', 'name');
    }
}
