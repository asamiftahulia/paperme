<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TimeDeposit;
use App\TD;
use App\MasterBank;
use App\M_branchs;
use PDF;
use Session;
use Validator;

class TDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = TD::All();
      //  return view('time-deposit-list', compact('data'));
        return view('list-td',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       // return view('time-deposit-form');
       //$banks= MasterBank::pluck('NAMA_BANK', 'KODE_LJK');
        $banks = MasterBank::all();
        $branch = m_branchs::all();
        return view('registrasi-td-form', compact('banks','branch'));
        // return view('registrasi-td-form');

    }

      public function summary()
    {
        //
        return view('dahboard');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $validatedData = $request->validate([
        // 'full_name' => 'required|max:3']);
        $validator = Validator::make($request->all(),[
            'full_name' => 'required',
            'amount' =>  'regex:/^\d*(\.\d{3})?$/',

        ]);
        $data = new TD();
        $data->full_name = $request->full_name; 
        $strAmount = filter_var($request->amount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $data->amount = $strAmount;
        $str = ltrim($request->amount, ',');
        $str = trim($request->amount);
       
        $data->status = '1';
        $data->notes = $request->notes;
        $data->expired_date = $request->expired_date;
        $data->period = $request->period;
        $data->type_of_td = $request->type_of_td;
        $data->bank = $request->bank;
        $data->date_rollover = $request->date_rollover;
        $data->special_rate = $request->special_rate;
        $data->normal_rate = $request->normal_rate;
        $data->id_branch = $request->branch;
        $data->created_by = 'asami@gmail.com';
        $data->updated_by = 'asami@gmail.com';
        $data->save();
       
       //return redirect('time-deposit/summary')->with('id',$data->id);
        return redirect('td/summary')->with('id',$data->id);
       // return redirect('td/summary')->with('id',$data->id);
       
        // if($validator->fails()){
        //     return redirect('time-deposit/create')->withErrors($validator)->withInput();
        // }else{
        //      Session::flash('flash_message','Yihha');
        // return redirect()->route('time-deposit.index');
        // }
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
        $id = session('id');
        $data = TD::where('id', $id)->get();
       
        $bm = 0;
        $am = 0;
        $rm = 0;
        $director = 0;
        $dataApprover = array(['AM','RH','Director']);
        foreach($data as $datas){
            if($datas['period'] == 1 || $datas['period'] == 3){
                if($datas['special_rate'] == '5.25' || $datas['special_rate'] <= '6.00'){
                    // echo'AM';
                    $dataApprover = array('approver'=>'AM');
                }else if($datas['special_rate'] == '5.25' || $datas['special_rate'] <= '6.25'){
                    $dataApprover = array('approver'=>'AM','RH');
                }else if($datas['special_rate'] == '5.25' || $datas['special_rate'] > '6.25'){
                    $dataApprover = array('approver'=>'AM','RH','Director');
                }else{
                    echo 'Approver Not Found';
                }
            }else if($datas['period'] == 6){
                if($datas['special_rate'] == '5.50' || $datas['special_rate'] <= '5.75'){
                    $dataApprover = array('approver'=>'AM');
                }else if($datas['special_rate'] == '5.50' || $datas['special_rate'] <= '6.00'){
                    $dataApprover = array('approver'=>'AM','RH');
                }else if($datas['special_rate'] == '5.50' || $datas['special_rate'] > '6.00'){
                    $dataApprover = array('approver'=>'AM','RH','Director');
                }else{
                    echo 'Approver Not Found';
                }
            }else if($datas['period'] == 12){
                if($datas['special_rate'] == '5.50' || $datas['special_rate'] <= '5.75'){
                    $dataApprover = array('approver'=>'AM');
                }else if($datas['special_rate'] == '5.50' || $datas['special_rate'] <= '60.00'){
                    $dataApprover = array('approver'=>'AM','RH');
                }else if($datas['special_rate'] == '5.50' || $datas['special_rate'] > '6.00'){
                    $dataApprover = array('approver'=>'AM','RH','Director');
                }else{
                    echo 'Approver Not Found';
                }
            }
        }
        return view('summary',compact('data', $data))->with('apr',$dataApprover);
        //echo $id;
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = TD::where('id',$id)->get();

        return view('registrasi-td-form-edit',compact('data'));
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
        $data = TD::where('id',$id)->first();
        $data->full_name = $request->full_name;

        $strAmount = filter_var($request->amount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $data->amount = $strAmount;
        $str = ltrim($request->amount, ',');
        $str = trim($request->amount);
        $data->type_of_td = $request->type_of_td;
        $data->special_rate = $request->special_rate;
        $data->normal_rate = $request->normal_rate;
        $data->expired_date = $request->expired_date;
        $data->date_rollover = $request->date_rollover;
        $data->period = $request->period;
        $data->notes = $request->notes;
        $data->save();

        return redirect('td/summary')->with('id',$data->id);
    }

    public function revisi(Request $request, $id)
    {
        // $data = TD::where('id',$id)->first();
        $data = TD::find($id);
        
        $data->special_rate = $request->special_rate;
     
        $data->save();

        return redirect('timeline/{id}')->with('id',$data->id);
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


    public function downloadSummary($id){
        $td = TD::find($id);
        $data = TD::where('id', $id)->get();    
        $pdf = PDF::loadView('pdf-summary',$data);
        return $pdf->download('Summary_Time_Deposit.pdf');
    }

    public function timeline($id){
        $data = TD::where('id', $id)->get();

          foreach($data as $datas){
            if($datas['period'] == 1 || $datas['period'] == 3){
                if($datas['special_rate'] == '5.25' || $datas['special_rate'] <= '6.00'){
                    // echo'AM';
                    $dataApprover = array('approver'=>'AM');
                }else if($datas['special_rate'] == '5.25' || $datas['special_rate'] <= '6.25'){
                    $dataApprover = array('approver'=>'AM','RH');
                }else if($datas['special_rate'] == '5.25' || $datas['special_rate'] > '6.25'){
                    $dataApprover = array('approver'=>'AM','RH','Director');
                }else{
                    echo 'Approver Not Found';
                }
            }else if($datas['period'] == 6){
                if($datas['special_rate'] == '5.50' || $datas['special_rate'] <= '5.75'){
                    $dataApprover = array('approver'=>'AM');
                }else if($datas['special_rate'] == '5.50' || $datas['special_rate'] <= '6.00'){
                    $dataApprover = array('approver'=>'AM','RH');
                }else if($datas['special_rate'] == '5.50' || $datas['special_rate'] > '6.00'){
                    $dataApprover = array('approver'=>'AM','RH','Director');
                }else{
                    echo 'Approver Not Found';
                }
            }else if($datas['period'] == 12){
                if($datas['special_rate'] == '5.50' || $datas['special_rate'] <= '5.75'){
                    $dataApprover = array('approver'=>'AM');
                }else if($datas['special_rate'] == '5.50' || $datas['special_rate'] <= '60.00'){
                    $dataApprover = array('approver'=>'AM','RH');
                }else if($datas['special_rate'] == '5.50' || $datas['special_rate'] > '6.00'){
                    $dataApprover = array('approver'=>'AM','RH','Director');
                }else{
                    echo 'Approver Not Found';
                }
            }
        }

        return view('timeline-td',compact('data',$data))->with('apr',$dataApprover);
    }
}
