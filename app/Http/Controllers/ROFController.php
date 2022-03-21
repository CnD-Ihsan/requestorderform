<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Models\ROF_Items_Category;
use App\Models\ROF_Item;
use App\Models\ROF ;
use App\Models\User ;
use App\Models\DailyCounter ;

//$url=route('rof');

class ROFController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $daily_counter= DailyCounter::find(1);
        $categories = ROF_Items_Category::all();
        $user = User::all();
        $rofs = ROF::orderBy('form_ref_no', 'desc')->paginate(20);
        $total_rof = ROF::all()->count();

        if ($daily_counter['current_date'] != date("d/m/Y")){
            $daily_counter['current_date']= date("d/m/Y");
            $daily_counter['counter']= 0;
            $daily_counter->save();
        }

        return view(route('indexROF'),[
            'rofs' => $rofs, 
            'categories' => $categories,
            'user' => $user,
            'daily_counter' => $daily_counter,
            'total_rof' => $total_rof,
        ]);
    }

    public function show(){
        return 'U sucks';
        
        // dd(ROF_Items_Category::all());
        // return view('rof');
    }

    public function update(){
        return 'U sucks';
        // dd(ROF_Items_Category::all());
        // return view('rof');
    }

    public function store(Request $request)
    {
        DailyCounter::where('id', 1)->update(['counter'=>$request->counter]);
        $rof = ROF::create([
            'requested_by' => $request->requested_by,
            'form_ref_no' => $request->form_ref_no,
            'project_type' => $request->project,
            'others' => $request->others,
            'date' => $request->date,
            'time' => $request->time,
            'order_type' => $request->request_order_type,
        ]);
        
        for($i = 1; $i < $request->indexNum; $i++){
  
            $remarks = "remarks" . (string)$i;
            $item_no = "item_no" . (string)$i;
            $link = "link" . (string)$i;
            $item_ref_no = "item_ref_no" . (string)$i;

            if($request->$item_ref_no==null)
                break;

            $rofi = ROF_Item::create([
                'form_ref_no' => $request->form_ref_no,
                'item_no' => $request->$item_no,
                'item_ref_no' => $request->$item_ref_no,
                'link' => $request->$link,
                'category' => $request->$remarks,
            ]);
        }

        return redirect('rof/rof')->with('message','Request Order successfully added.');
    }

}
