<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ROF_Items_Category extends Model
{
    use HasFactory;
    protected $table = 'rof_items_categories';

    public function rofItems(){
        return $this->belongsTo(ROF_Item::class);
    }
}
