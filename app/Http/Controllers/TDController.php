<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TimeDeposit;
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
        $data = TimeDeposit::All();
        return view('timedepositlist', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('time-deposit-form');

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
        $data = new TimeDeposit();
        $data->full_name = $request->full_name;
        $data->amount = $request->amount;
        $data->status = $request->status;
        $data->notes = $request->notes;
        $data->expired_date = $request->expired_date;
        $data->period = $request->period;
        // $data->type_of_td = $request->type_of_td;
        // $data->id_bank = $request->id_bank;
        // $data->date_rollover = $request->date_rollover;
        // $data->special_rate = $request->special_rate;
        // $data->normal_rate = $request->normal_rate;
        // $data->id_branch = $request->id_branch;
        // $data->created_by = 'asami@gmail.com';
        // $data->updated_by = 'asami@gmail.com';
        $data->save();
       
        // return redirect()->route('time-deposit.create')->with('id',$data->id);

        if($validator->fails()){
            return redirect('time-deposit/create')->withErrors($validator)->withInput();
        }else{
             Session::flash('flash_message','Yihha');
        return redirect()->route('time-deposit.index');
        }
        
        
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
