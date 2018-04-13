<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TimeDeposit;
use App\TD;
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
        return view('registrasi-td-form');

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
       
        $data->status = $request->status;
        $data->notes = $request->notes;
        $data->expired_date = $request->expired_date;
        $data->period = $request->period;
        $data->type_of_td = $request->type_of_td;
        $data->bank = '000002';
        $data->date_rollover = $request->date_rollover;
        $data->special_rate = '1';
        $data->normal_rate = '1';
        $data->id_branch = '1';
        $data->created_by = 'asami@gmail.com';
        $data->updated_by = 'asami@gmail.com';
        $data->save();
       
       //return redirect('time-deposit/summary')->with('id',$data->id);
        return redirect('td/summary')->with('id',$data->id);
       
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
        return view('summary',compact('data', $data));
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


    public function downloadSummary($id){
        $td = TD::find($id);
        $data = TD::where('id', $id)->get();    
        $pdf = PDF::loadView('pdf-summary');
        return $pdf->download('Summary_Time_Deposit.pdf');
    }

    public function timeline($id){
        return view('timeline-td');
    }
}
