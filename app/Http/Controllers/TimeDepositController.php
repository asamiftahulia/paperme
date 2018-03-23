<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TimeDeposit;
use Session;

class TimeDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('new-customer-new-dep');
    }

    public function list(){
        return view('new-customer-new-dep');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $id = session('id');
        $data = TimeDeposit::where('id', $id)->get();
        return view('summary',compact('data', $data));
        echo $id;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = new TimeDeposit();
        $data->bank = $request->bank;
        $data->tipe = $request->tipe;
        $data->amount = $request->amount;
        $data->rate = $request->rate;
        $data->period = $request->period;
        $data->td = $request->td;
        $data->customer_id = $request->customer_id;
        $data->save();
        Session::flash('flash_message','yeay');
        return redirect()->route('timedeposit.create')->with('id',$data->id);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $data = TimeDeposit::all();
        return view('timedepositlist',compact('data'));
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
