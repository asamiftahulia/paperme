<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Http\Request;
use PDF;
use App\TD;
use Illuminate\Support\Facades\Input;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return view('test');
        // return view('new-customer-new-dep');
        //  return view('test-datatables');
        //return view('test-form');
       // return view('test-summary-pdf');
      // return view('form-registrasi');
    // return view('test-datepicker');
      //  return view('test-timeline');
    //   $td = TD::find(53);
    //   $data = TD::where('id', 53)->get(); 
    // //   $pdf = PDF::loadView('pdf-summary',compact('data',$data));
    //  return view('pdf-summary',compact('data',$data));

     return view('login');
    
        
    }

    public function toastrFunction(){
        $name = Input::get('testname');

        if($name=='laravel'){
            echo "success";
            $notification = array(
                'message' => 'Successfully Get Laravel Data !',
                'alert-type' => 'success'
            );
        }else if($name=='found'){
            echo "info";
            $notification = array(
                'message' => 'Info Get Laravel Data !',
                'alert-type' => 'info'
            );
        }else if($name=='notfound'){
            echo "warning";
            $notification = array(
                'message' => 'Warning Get not found Laravel Data !',
                'alert-type' => 'warning'
            );
        }else{
            echo "error";
            $notification = array(
                'message' => 'error Get Laravel Data !',
                'alert-type' => 'error'
            );
        }
        return back()->with($notification);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
           return view('summary');
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

    public function downloadPDF($id){
        $customers = Customer::find($id);
        $data = Customer::where('id', 1)->get();
        $pdf = PDF::loadView('pdf',$data);
        return $pdf->download('invoice.pdf');
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
