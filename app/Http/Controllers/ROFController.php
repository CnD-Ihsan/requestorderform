<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Models\ROF_Items_Category;
use App\Models\ROF_Item;
use App\Models\ROF;
use App\Models\User ;
use App\Models\DailyCounter ;
use PDF;
use DB;
use Alert;

//$url=route('indexROF');

class ROFController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        $daily_counter= DailyCounter::find(1);
        $categories = ROF_Items_Category::all();

        if ($daily_counter['current_date'] != date("d/m/Y")){
            $daily_counter['current_date']= date("d/m/Y");
            $daily_counter['counter']= 0;
            $daily_counter->save();
        }

        return view('rof/create',compact("categories","daily_counter"));
    }

    public function index(){
            
        if (Auth::user()->user_type == 'HOD')
            $rofs = ROF::orderBy('form_ref_no', 'desc')->paginate(20);
        else
            $rofs = ROF::where('requested_by', '=', Auth::user()->name)->orderBy('form_ref_no', 'desc')->paginate(20);

        $total_rof = ROF::all()->count();        
        $users = User::where('user_type','=','User')->get();
        $categories = ROF_Items_Category::all();

        return view('rof/index', compact("rofs", "total_rof", "users", "categories"));

    }

    public function show($rof_id){
        $details = ROF::with('rofItems')->find($rof_id);
        return view('rof/show',[
            'details'=> $details,
    ]);
    }

    public function edit($rof_id){
        $details = ROF::with('rofItems')->find($rof_id);
        $categories = ROF_Items_Category::all();

        return view('rof/edit',compact("details", "categories"));
    }

    public function update($rof_id, $action){

    }

    public function approve_rof($rof_id){

        if(Auth::user()->user_type != 'HOD')
            return redirect('rof/index')->with('message','Unauthorized action!');
        else {
                $approval = ROF::where('rof_id', $rof_id)->update([
                    'approved_by'=>Auth::user()->name,
                    'approved_at'=>date("Y-m-d H:i:s"),
                    'status' => 'Approved',
                ]);
                return redirect('rof/index')->with('message','Request Order succesfully approved!');
        }

    }

    public function reject_rof($rof_id, Request $request){

        if(Auth::user()->user_type != 'HOD')
            return redirect('rof/index')->with('message','Unauthorized action!');
        else {
                $approval = ROF::where('rof_id', $rof_id)->update([
                    'status'=>'Rejected',
                    'remarks'=> $request->remarks,
                ]);
                return redirect('rof/index')->with('message','Request Order rejected!');
            }
    }

    public function store(Request $request)
    {

        DailyCounter::where('daily_counter_id', 1)->update(['counter'=>$request->counter]);
        $rof = ROF::create([
            'requested_by' => $request->requested_by,
            'form_ref_no' => $request->form_ref_no,
            'project_type' => $request->project,
            'others' => $request->others,
            'date' => $request->date,
            'time' => $request->time,
            'order_type' => $request->request_order_type,
            'status' => 'Pending',
        ]);
        
        $labelCounter = [0,0,0];
        $item_no = 0;

        for($i = 1; $i <= $request->indexNum; $i++){
  
            $remarks = "remarks" . (string)$i;
            if($request->$remarks==null)
                break;
            if ($request->$remarks=='blank')
                continue;
            $link = "link" . (string)$i;   

            $link_ref_no = (new ROF_ItemsController)->linkRefNoBuilder($request->$remarks, $labelCounter);
            $item_no++;

            $rofi = ROF_Item::create([
                'form_ref_no' => $request->form_ref_no,
                'item_no' => $item_no,
                'item_ref_no' => $link_ref_no,
                'link' => $request->$link,
                'category' => $request->$remarks,
            ]);
        }

        return redirect('rof/index')->with('message','Request Order successfully added.');
    }

    public function toPDF($rof_id){
        //return 'U ducks';
        $details = ROF::find($rof_id);
        $pdf_name = $details['form_ref_no'].'.pdf';
        view()->share('details', $details);
        $pdf = PDF::setPaper('A4','portrait')->loadView('pdf', ['details' => $details]);
        //dd($details);
        return $pdf->download($pdf_name);
    }

    public function datatableBuilder(Request $request){
        if($request->ajax()){
            $minDate = date($request->minDate);
            $maxDate = date($request->maxDate);

            $rofs = ROF::with('user')->get();
            //$rofs = DB::table('rof')->where('date', $request->minDate)->get();
            
            //filter table to only show what form they had requested
            if(Auth::user()->user_type == 'User'){
                $rofs = $rofs->where('requested_by', Auth::user()->name);
            }

            //daterange filter
            if (!empty($minDate) && !empty($maxDate)){
                $rofs = $rofs->whereBetween('date', [$minDate, $maxDate]);
            }
            else if (!empty($minDate)){
                $rofs = $rofs->where('date', '>=', $minDate);   
            }
            else if (!empty($maxDate)){
                $rofs = $rofs->where('date', '<=', $maxDate);
            }

            return datatables()->of($rofs)
                ->addColumn('action', function($rofs){
                    $button = '<a id="show_'.$rofs->rof_id.'" href="'.route('showROF', [$rofs->rof_id]).'" class="btn btn-dark m-1">See Details</a>';
                    if (Auth::user()->user_type == 'HOD'){
                        if ($rofs->status == 'Pending'){
                            // '.route('updateROF', [$rofs->rof_id, 'approve']).'
                            $button .= '<button onclick="approveROF('.$rofs->rof_id.')" class="approve-button btn btn-success m-1">Approve</button>'; 
                            $button .= '<button onclick="rejectROF('.$rofs->rof_id.')" class="reject-button btn btn-danger m-1">Reject</button>';         
                        }
                    } 
                      
                    return $button;
                })
  
            ->rawColumns(['action'])
            ->make(true);
        }
        return redirect()->route('indexROF');
    }

}
