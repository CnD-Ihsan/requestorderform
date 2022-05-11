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
use Mail;
use App\Mail\NotificationEmail;

//$url=route('indexROF');

class ROFController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        $daily_counter= DailyCounter::find(1);
        $categories = ROF_Items_Category::all();
        $contractors = User::first()->getContractorList();

        if ($daily_counter['current_date'] != date("d/m/Y")){
            $daily_counter['current_date']= date("d/m/Y");
            $daily_counter['counter']= 0;
            $daily_counter->save();
        }

        return view('rof/create',compact("categories", "daily_counter", "contractors"));
    }

    public function index(){
            
        if (Auth::user()->user_type == 'HOD')
            $rofs = ROF::orderBy('form_ref_no', 'desc')->paginate(20);
        else
            $rofs = ROF::where('requested_by', '=', Auth::user()->name)->orderBy('form_ref_no', 'desc')->paginate(20);

        $total_rof = ROF::all()->count();       
        //get list of users to be used as filter for index page 
        $users = User::where('user_type','=','User')->get(); 
        $categories = ROF_Items_Category::all();

        return view('rof/index', compact("rofs", "total_rof", "users", "categories"));

    }

    public function show($rof_id){
        $details = ROF::with('rofItems')->findOrFail($rof_id);
        $requested_by = User::where('name' , $details['requested_by'])->first()->email;
        $checked_by = User::where('name' , $details['checked_by'])->first();

        if(!$checked_by){
            $checked_by = "Pending";
        }
        else{
            $checked_by = $checked_by->email;
        }

        return view('rof/show',compact("details", "requested_by", "checked_by"));
    }

    public function edit($rof_id){
        $details = ROF::with('rofItems')->find($rof_id);
        $contractors = User::first()->getContractorList();

        if(Auth::user()->name == $details->requested_by){
            $categories = ROF_Items_Category::all();
            return view('rof/edit',compact(
                "details", 
                "categories", 
                "contractors"
            ));
        }
        else{
            return redirect('rof/index')->with('message','Form not found.');
        }

    }

    public function update(Request $request, $rof_id){
        $rof = ROF::where('rof_id', $rof_id)
                    ->update([
                        'received_by' => $request->contractor,
                        'project_type' => $request->project,
                        'others' => $request->others,
                        'order_type' => $request->request_order_type,
                    ]);
        
        $labelCounter = [0,0,0];
        $item_no = 0;
        ROF_Item::where('form_ref_no', '=',  $request->form_ref_no)->delete();

        for($i = 1; $i <= $request->indexNum; $i++){
  
            $remarks = "remarks" . (string)$i;
            $link = "link" . (string)$i;  
            if($request->$remarks==null || $request->$remarks=='blank'){
                continue;
            }
                
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
        return redirect()->back()->with('message','Request Order details updated.');
    }

    public function approve_rof($rof_id){
        if(Auth::user()->user_type != 'HOD')
            return redirect('rof/index')->with('message','Unauthorized action!');
        else {
                $approval = ROF::where('rof_id', $rof_id)->update([
                    'checked_by'=>Auth::user()->name,
                    'checked_at'=>date("Y-m-d H:i:s"),
                    'status' => 'Approved',
                ]);
                return redirect()->back()->with('message','Request Order succesfully approved!');
        }
    }

    public function reject_rof($rof_id, Request $request){
        if(Auth::user()->user_type != 'HOD')
            return redirect('rof/index')->with('message','Unauthorized action!');
        else {
                $approval = ROF::where('rof_id', $rof_id)->update([
                    'checked_by'=>Auth::user()->name,
                    'checked_at'=>date("Y-m-d H:i:s"),
                    'status'=>'Rejected',
                    'remarks'=> $request->remarks,
                ]);
                $this->sendEmail($rof->rof_id);
                return redirect()->back()->with('message','Request Order rejected!');
            }
    }

    public function receive_rof($rof_id){
        if(Auth::user()->user_type != 'Contractor')
            return redirect('rof/index')->with('message','Unauthorized action!');
        else {
                $approval = ROF::where('rof_id', $rof_id)->update([
                    'received_by'=>Auth::user()->name,
                    'received_at'=>date("Y-m-d H:i:s"),
                ]);
                return redirect('rof/'.$rof_id)->with('message','Request Order received by: '.Auth::user()->name);
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
            'request_to' => $request->contractor,
            'date' => $request->date,
            'time' => $request->time,
            'order_type' => $request->request_order_type,
            'status' => 'Pending',
        ]);
        
        $labelCounter = [0,0,0];
        $item_no = 0;

        for($i = 1; $i <= $request->indexNum; $i++){
  
            $remarks = "remarks" . (string)$i;
            $link = "link" . (string)$i;  

            if($request->$remarks==null || $request->$remarks=='blank'){
                continue;
            }
                
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
        $this->sendEmail($rof->rof_id);
        return redirect('rof/index')->with('message','Request Order successfully added.');
    }

    public function toPDF($rof_id){
        //return 'U ducks';
        $details = ROF::findOrFail($rof_id);
        $requested_by = User::where('name' , $details['requested_by'])->first()->email;
        $checked_by = User::where('name' , $details['checked_by'])->first();

        if(!$checked_by){
            $checked_by = "Pending";
        }
        else{
            $checked_by = $checked_by->email;
            $checked_by = base64_encode(file_get_contents(public_path('img/HOD/'.$checked_by.'.png')));
        }

        $requested_by = base64_encode(file_get_contents(public_path('img/USER/'.$requested_by.'.png')));

        view()->share('details', $details);
        $pdf = PDF::setPaper('A4','portrait')->loadView('pdf', compact("details","requested_by", "checked_by"));
        return $pdf;
    }

    public function downloadPDF($rof_id){
        $pdf_name = ROF::findOrFail($rof_id)->form_ref_no;
        $pdf_name = $pdf_name.'.pdf';

        $pdf = $this->toPDF($rof_id);
        return $pdf->stream($pdf_name, array('Attachment'=>0));
    }

    public function datatableBuilder(Request $request){
        if($request->ajax()){
            
            $minDate = date($request->minDate);
            $maxDate = date($request->maxDate);
            $content = $request->searchContent;

            $rofs = ROF::with('user', 'rofItems');
            
            //filter table to only show what form they had requested
            if(Auth::user()->user_type == 'User'){
                $rofs = $rofs->where('requested_by', Auth::user()->name);
            } else if(Auth::user()->user_type == 'Contractor'){
                $rofs = $rofs->where('request_to', Auth::user()->dept)->where('status', 'Approved');
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

            //this filter finds ROFs that contain a specified item category
            if (!empty($content) && $content != 'blank'){
                $rofs = $rofs->whereRelation('rofItems', 'category', '=', $content)->get();
            }

            return datatables()->of($rofs)
                ->addColumn('action', function($rofs){
                    $button = '<a id="show_'.$rofs->rof_id.'" href="'.route('showROF', [$rofs->rof_id]).'" class="btn btn-dark m-1">See Details</a>';
                    if (Auth::user()->user_type == 'HOD'){
                        if ($rofs->status == 'Pending'){
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
    
    public function sendEmail($rof_id){
        $details = ROF::find($rof_id);
        $pdf = $this->toPDF($rof_id);

        $data = compact("pdf", "details");

        Mail::to('ihsanuddin@ctsabah.com.my')-> send(new NotificationEmail($data));
        return 'what do';
    }

}
