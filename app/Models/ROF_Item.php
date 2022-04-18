<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ROF_Item extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'rof_items';
    protected $primaryKey = 'rof_item_id';

    protected $attributes = [
        'link'=>'',
        'item_no'=>'',
    ];

    protected $fillable = [
        'form_ref_no',
        'item_ref_no',
        'item_no',
        'link',
        'remarks',
        'category',
    ];

    public function rofItemsCategory(){
        return $this->hasMany(ROF_Items_Category::class);
    }

    public function rof(){
        return $this->belongsTo(ROF::class, 'form_ref_no');
    }
}
