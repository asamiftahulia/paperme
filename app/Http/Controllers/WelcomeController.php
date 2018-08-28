<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\transaction_td;
use App\TD;
use App\TD_USER;
use App\Mail\PostSubscribtion;
use Mail;
use DB;
use Illuminate\Support\Facades\Input;

class WelcomeController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }

    public function index(){
        return view('test-ajax');
    }
    public function getRequest(Request $request){
        if($request->ajax()){
            $data = new transaction_td();
            $counter = $request->counter;
            $rool = $request->role;
            for($i = 1; $i<=$counter; $i++){
                //bikin variable yg ada counternya
                $dataID = 'id_td'.$i;
                $dataName = 'name'.$i;
                $dataSR = 'special_rate'.$i;
                $dataAksi = 'aksi'.$i;
                $dataRole = 'role'.$i;
                $dataUser = 'user'.$i;
                //masukin ke array
                $datasID[$i] = $request->$dataID;
                $datasName[$i] = $request->$dataName;
                $datasSR[$i] = $request->$dataSR;
                $datasAksi[$i] = $request->$dataAksi;
                $datasRole[$i] = $request->$dataRole;
                $datasUser[$i] = $request->$dataUser;

                echo $datasName[$i].' ';
                echo $datasSR[$i].' ';
                echo $datasAksi[$i].' ';
                echo $datasRole[$i].' ';
                echo $datasUser[$i].' ';
                echo "</br>";
                //insert ke trx TD
                $data = new transaction_td();
                $data->id_td = $datasID[$i];
                $data->approved = 1;
                $data->aksi=$datasAksi[$i];
                $data->special_rate=$datasSR[$i];
                $data->role=$datasRole[$i];
                $data->created_by = $datasUser[$i];
                $data->approved_by = $datasUser[$i];
                $today = date("Y-m-d");
                $data->approved_at = $today;
                $result = $data->save();

                //edit TD guna untuk tau bahwa pengajuan ini sudah ada aksi
                $td = TD::find($datasID[$i]);
                $td->action = 1;
                $td->save();
            }
            return dd(response()->json(['status' => 'success']));
          }else{
            return dd(response()->json(['status' => 'error']));
          }
    }

  
    public function getIdMemmo(int $idMemmo){
        $dataDede = DB::table('time-deposit')
            ->select('*')
            ->where('id_memmo','=',$idMemmo)
            ->get();
        $count = 2;
        return response()->json($dataDede);

    }

    public function insertKeTRXTD(Request $request){
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
         return redirect('timeline/'.$data->id_td)->with($notification);
        //return redirect()->back()->with($notification);
    }
    public function testAjax(){
        dd('success');
    }
}
