<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use View;
use Session;
use App\TD;
use App\TD_USER;
use DB;
use Illuminate\Support\Facades\Input;
use App\FlowMapping;
use App\UserJob;

class LoginApiController extends Controller
{
    public function __construct(){
        $this->client = new Client();

    }

    public function showLogin(){
        return View::make('login');
        $data = $request->fullUrl();
        dd($data);
        dd($request->all());
        
    }
    public function doLogin(){
        $client = new Client([
           'headers'=>['content-type'=>'application/json','X-Auth-Token'=>'fa6dce03-de34-4534-9c51-06eafa50f23e'],
        ]);
        
        $email = Input::get('email');
        $password = Input::get('password');

       $response = $client->post('http://10.110.113.57:8015/login', ['json'=>['username'=>$email,'password'=>$password]]);
        $data = $response->getBody();

       $data = json_decode($data);
    //    asli
    //berapa job nya
    $jumlahJobUser = count($data->userJobs);
    // dd($jumlahJobUser);
    for($i = 0; $i<$jumlahJobUser; $i++){
        // echo "<script type='text/javascript'>alert($i);</script>";
    
        session(['token' => $data->token,
        'username'=> $data->username,
        'nik' => $data->employee->nik,
        'nama'=> $data->employee->nama,
        'branch'=> $data->userJobs[$jumlahJobUser-1]->userJobPK->idBranch,
        'job'=> $data->userJobs[$jumlahJobUser-1]->userJobPK->idJobs]);
        $nik = session('nik');
        // echo "<script type='text/javascript'>alert(".$jumlahJobUser.");</script>";
        // dd(session('job'));
    }
    
    // echo "<script type='text/javascript'>alert(".$nik.");</script>";
        //palsu
        
        // session(['token' => '1234567',
        // 'username'=> $username,
        // 'nik' => '09 0859',
        // 'nama'=> 'Agus',
        // 'branch'=> 'ID0010006',
        // 'job'=> 'S0301']);

        // jalan
        //  session(['token' => '1234567',
        //  'username'=> 'anisentus.yoseph@idn.ccb.com',
        //  'nik' => '17 3694',
        //  'nama'=> 'Lim ',
        //  'branch'=> 'ID0010028',
        //  'job'=> 'S0309']);

        // session(['token' => '1234567',
        //  'username'=> 'tien.muntiara@idn.ccb.com',
        //  'nik' => '17 3694',
        //  'nama'=> 'Lim ',
        //  'branch'=> 'ID0010028',
        //  'job'=> 'S0362']);

            // session(['token' => '1234567',
            // 'username'=> 'rahman.fianto@idn.ccb.com',
            // 'nik' => '17 3694',
            // 'nama'=> 'Lim ',
            // 'branch'=> 'ID0010028',
            // 'job'=> 'S0465']);

            // session(['token' => '1234567',
            // 'username'=> 'agus.setiawan@idn.ccb.com',
            // 'nik' => '17 3694',
            // 'nama'=> 'Lim ',
            // 'branch'=> 'ID0010028',
            // 'job'=> 'S0301']);

         
        // session(['token' => '1234567',
        //  'username'=> $email,
        //  'nik' => $password,
        //  'nama'=> 'Lim ',
        //  'branch'=> 'ID0010028',
        //  'job'=> 'S0148']);
        
        //  09 0859
       // dd(session('username'),session('token'), session('nik'), session('nama'), session('branch'), session('job'));
       // dd(session('job'));
       // dd($data);
       $id_branch = session('branch');
    //    dd($id_branch);
       $flow = FlowMapping::where('id',$id_branch)->get();
        foreach($flow as $data)
        {
            $path = explode(';',$data->path);
            $countPath = count($path);
            for($i = 0; $i<$countPath;$i++){
                if($id_branch == 'ID0010001'){
                    $userBM = UserJob::where('id_branch',$id_branch)->where('id_jobs','S0362')->get();
                    $userAM = UserJob::where('id_branch',$path[0])->where('id_jobs','S0465')->get();
                    $userRH = UserJob::where('id_branch',$path[0])->where('id_jobs','S0301')->get();
                    $userDR = 'setiawati.samahita@idn.ccb.com';
                    // echo "<script> alert('asaaa')</script>";
                }else{
                    if($countPath==4){
                        //cocok eko
                        $userBM = UserJob::where('id_branch',$id_branch)->where('id_jobs','S0362')->get();
                        $userAM = UserJob::where('id_branch',$path[1])->where('id_jobs','S0465')->get();
                        $userRH = UserJob::where('id_branch',$path[2])->where('id_jobs','S0301')->get();
                        $userDR = 'setiawati.samahita@idn.ccb.com';
                    }else{
                        //cocok buat eko
                        $userBM = UserJob::where('id_branch',$id_branch)->where('id_jobs','S0465')->get();
                        $userAM = UserJob::where('id_branch',$id_branch)->where('id_jobs','S0465')->get();
                        $userRH = UserJob::where('id_branch',$path[1])->where('id_jobs','S0301')->get();
                        $userDR = 'setiawati.samahita@idn.ccb.com';
                        // echo "<script type='text/javascript'>alert('Non Jabodetabek');</script>";
                    }
                }
            }
            
        }

       
    //    $userBM = UserJob::where('id_branch',$id_branch)->get();
    //    $userAM = UserJob::where('id_branch','AR0012')->get();
    //    $userRH = UserJob::where('id_branch','AR0001')->get();
    //    $userDR = UserJob::where('id_branch','AR0001')->get();

    //    session(['bm'=>$userBM[0]->username,
    //    'am'=>$userAM[0]->username,
    //    'rh'=>$userRH[0]->username,
    //    'dr'=>$userDR]);

    //    return View('user-mapping-test',compact('token',
    //    'username',
    //    'nik',
    //    'nama',
    //    'branch',
    //    'job',
    //    'flow',
    //    'userBM','userAM','userRH','userDR','bm','am','rh','dr'
    // ));
        
    $data = TD::All();
    //  return view('time-deposit-list', compact('data'));
      $tdUser = TD_USER::All();
      $lengkap = DB::table('time-deposit')
          ->select('*')
          ->join('td_user', 'time-deposit.id', '=', 'td_user.id_td')
          ->orderBy('time-deposit.id','asc')
          ->get();
      // dd($lengkap);
      return view('list-td',compact('data','trx','tdUser','lengkap'));

     
    }

    public function logout(){
        $client = new Client([
            'headers'=>['content-type'=>'application/json','X-Auth-Token'=>session('token')],
         ]);
         session(['token' => '',
         'username'=> '',
         'nik' =>'',
         'nama'=> '',
         'branch'=> '',
         'job'=> '']);
        $response = $client->DELETE('http://10.110.113.57:8015/login', ['json'=>['username'=>'harsya.mifta@idn.ccb.com','password'=>'asaasaasa']]);
 
         $data = $response->getBody();
         $data = json_decode($data);
        //  dd($data);

        if($data!=''){
            echo "Logout Successfull";
            $notification = array(
                'message' => 'The Data Has Been Revised',
                'alert-type' => 'logout success'
            );
        }else{
            echo "error";
            $notification = array(
                'message' => 'Logout Failed',
                'alert-type' => 'error'
            );
        }

        return view('login')->with($notification);

    }

}
