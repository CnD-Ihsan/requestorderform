<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ROF extends Model
{
    use HasFactory;
    protected $table = 'rof';
    protected $primaryKey = 'rof_id';
    protected $attributes = [
        'approved_at'=>null,
        'approved_by'=>'',
        'received_by'=>'',
        'received_at'=>null
    ];
    public $timestamps = false;

    protected $guarded = [
        'rof_id',
    ];

    public function rofItems(){
        return $this->hasMany(ROF_Item::class, 'form_ref_no','form_ref_no');
    }

    public function user(){
        return $this->belongsTo(User::class, 'requested_by', 'name');
    }

    public static function filterROF($status_filter = null, $user_filter = null, $order_type_filter = null, $from_filter = null, $to_filter = null, $ref_no_filter = null){

        $rofs = new ROF;
        
        if($status_filter){
            $rofs = $rofs->where('status', $status_filter);
        }
        if($user_filter){
            $rofs = $rofs->where('requested_by', $user_filter);
        }
        if($order_type_filter){
            $rofs = $rofs->where('order_type', $order_type_filter);
        }
        if($from_filter){
            $rofs = $rofs->where('date','>=', $from_filter);
        }
        if($to_filter){
            $rofs = $rofs->where('date', '<=', $to_filter);
        }
        if($ref_no_filter){
            $rofs = $rofs->where('form_ref_no', $ref_no_filter);
        }
        return $rofs->paginate(10);
    }
}
