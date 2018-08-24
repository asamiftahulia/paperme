<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\transaction_td;
use App\TD;
use App\TD_USER;
use App\Mail\PostSubscribtion;
use App\Mail\EmailApprover;
use Mail;
use DB;
use Illuminate\Support\Facades\Input;


class TransactionTimeDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('trx-time-deposit-form');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //approve
    public function store(Request $request)
    {
        $data = new transaction_td();
        $count = 0;
        $data->id_td = $request->id_td;
        $data->approved = 1;
        $data->aksi='Approve';
        $data->special_rate=$request->special_rate;
        $data->role=$request->role;
        $data->created_by = session('username');
        $data->approved_by = session('username');
        $today = date("Y-m-d");
        $data->approved_at = $today;
        $result = $data->save();
        
        $td = TD::find($request->id_td);
        $td->action = 1;
        $td->save();

      //ambil email selanjutnya
        
        
        if($request->role == 'Branch Manager'){
            $td_user = DB::table('td_user')
            ->select('*')->where('id_td',$request->id_td)->pluck('am');
        }else if($request->role == 'Area Manager'){
            $td_user = DB::table('td_user')
            ->select('*')->where('id_td',$request->id_td)->pluck('rh');
        }else if($request->role == 'Regional Head'){
            $td_user = DB::table('td_user')
            ->select('*')->where('id_td',$request->id_td)->pluck('dr');
        }else if($request->role == 'Director'){
            $td_user[0] = 'harsya.mifta@idn.ccb.com';
        }
        

        if($result==1){
            echo "success";
            echo $td_user[0];
            $act = 0;
            $notification = array(
                'message' => 'Approved Successfull & Email Has Been Sent',
                'alert-type' => 'success',
                'act' => 0
            );
            
        }else if($result==0){
            echo "error";
            $notification = array(
                'message' => 'Error ! Can not Save Data ',
                'alert-type' => 'error'
            );
        }
        
        //tduser nya emailnya
        // $td_user[0]

        $td = TD::where('id',$request->id_td)->get();
        
        Mail::to('Harsyami@gmail.com')->send(new EmailApprover($td));
        
         return redirect('timeline/'.$data->id_td)->with($notification);
        
    }

    public function storeCol(Request $request){
      
        $data = new transaction_td();
        $count = 0;
        $data->approved = 1;
        $data->id_td = $request->id_td;
        $data->aksi=$request->aksi;
        $data->special_rate=$request->special_rate;
        $data->role=$request->role;
        $data->created_by = session('username');
        $data->approved_by = session('username');
        $today = date("Y-m-d");
        $data->approved_at = $today;
        $result = $data->save();
        
        $td = TD::find($request->id_td);
        $td->action = 1;
        $td->save();

        if($result==1){
            echo "success";
            $act = 0;
            $notification = array(
                'message' => 'Approved Successfull & Email Has Been Sent',
                'alert-type' => 'success',
                'act' => 0
            );
            
        }else if($result==0){
            echo "error";
            $notification = array(
                'message' => 'Error ! Can not Save Data ',
                'alert-type' => 'error'
            );
        }

    //    Mail::to('AreaManager@gmail.com')->send(new PostSubscribtion($data));
        // return redirect('timeline/'.$data->id_td)->with($notification);
        dd($data->id_td);
    }

    public function revisi(Request $request, $id)
    {
       // $data = TD::where('id',$id)->first();
        $data = new transaction_td();
        // $data = transaction_td::find($id);
        $data->id_td = $id;
        $data->approved = 0;
        $data->aksi='Revisi';
        $data->special_rate = $request->special_rate;
        $data->role=$request->role;
        $data->created_by = session('username');
        $data->approved_by = session('username');
        $data->approved_at = date("Y-m-d");

        $td = TD::find($id);
        $td->special_rate = $request->special_rate;
        $tdResult = $td->save();

        $result = $data->save();
        
        if($result==1){
            echo "success";
            $notification = array(
                'message' => 'The Data Has Been Revised',
                'alert-type' => 'success'
            );
        }else if($result==0){
            echo "error";
            $notification = array(
                'message' => 'Error ! Can not Save Data',
                'alert-type' => 'error'
            );
        }
        $sr = $data->special_rate;

        return redirect('timeline/'.$data->id_td)->with($notification);
    }

    public function reject(Request $request){
        $data = new transaction_td();
        $data->id_td = $request->id_td;
        $data->approved = 0;
        $data->special_rate=$request->special_rate;
        $data->role=$request->role;
        $data->aksi='Reject';
        $data->created_by = session('username');
        $data->approved_by = session('username');
        $data->approved_at = date("Y-m-d");
        $result = $data->save();

        if($result==1){
            echo "success";
            $notification = array(
                'message' => 'Rejected Successfull',
                'alert-type' => 'success'
            );
        }else if($result==0){
            echo "error";
            $notification = array(
                'message' => 'Error ! Can not Save Data',
                'alert-type' => 'error'
            );
        }

        $td = TD::find($request->id_td);
        $td->status = 'Rejected';
        $tdResult = $td->save();

       return redirect()->back()->with($notification);
    }

   

    public function special_rate($period, $special_rate){
        $approver = 0.00;
        
        if($period == 1 || $period == 3){
            if($special_rate >= 5.25 && $special_rate <=6.00)
            {
                $approver = 2;
            }
            else if($special_rate > 6.00 && $special_rate <= 6.25)
            {
                $approver = 3;
            }
            else if($special_rate > 6.25)
            {
                $approver = 4;
            }
        }else if($period == 6){
            if($special_rate >= 5.50 || $special_rate <=5.75)
            {
                $approver = 2;
            }
            else if($special_rate >= 5.50 || $special_rate <= 6.00)
            {
                $approver = 3;
            }
            else if($special_rate >= 5.50 || $special_rate > 6.00)
            {
                $approver = 4;
            }
        }else if($period == 12){
            if($special_rate >= 5.50 || $special_rate <=5.75)
            {
                $approver = 2;
            }
            else if($special_rate >= 5.50 || $special_rate <= 6.00)
            {
                $approver = 3;
            }
            else if($special_rate >= 5.50 || $special_rate > 6.00)
            {
                $approver = 4;
            }
        }else{
            echo "approver not found";
        }
          return $approver;
    }
    public function validasiApprover(Request $request, $id){
        // $data = transaction_td::find($id);
       
        $count = transaction_td::where('id_td',$id)->count();
        $td = TD::where('id', $id)->get();
        $data = TD::find($id);
        $data->status = 'FINISH';
        $data->save();

        foreach($td as $data){
            $special_rate = $data->special_rate;  
            $period = $data->period;  
            $periods = $data->status;
        
        }
        
        $approver = self::special_rate($period,$special_rate);
        if($count == $approver)
            return redirect(route('td.index'))->with('message','Operation Successful !');
        else 
            return redirect(route('td.index'))->with('message','Operation Successful !');
        
        // echo "period = ".$period;
        // echo "special = ".$special_rate;
        // echo "count = ".$count;
        // echo "approver ".$approver;
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
