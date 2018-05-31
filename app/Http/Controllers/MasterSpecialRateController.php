<?php

namespace App\Http\Controllers;

use App\MasterSpecialRate;
use App\SpecialRate;
use Illuminate\Http\Request;

class MasterSpecialRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $data = MasterSpecialRate::All();
        $data = SpecialRate::All();
        return view('master-special-rate-list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MasterSpecialRate  $masterSpecialRate
     * @return \Illuminate\Http\Response
     */
    public function show(MasterSpecialRate $masterSpecialRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MasterSpecialRate  $masterSpecialRate
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterSpecialRate $masterSpecialRate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MasterSpecialRate  $masterSpecialRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterSpecialRate $masterSpecialRate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MasterSpecialRate  $masterSpecialRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterSpecialRate $masterSpecialRate)
    {
        //
    }
}
