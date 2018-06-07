<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use View;
use Session;
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

    //    $response = $client->post('http://192.168.1.57:8015/login', ['json'=>['username'=>'anisentus.yoseph@idn.ccb.com','password'=>'17 3694']]);
        //$data = $response->getBody();

     //   $data = json_decode($data);
    //    asli
        // session(['token' => $data->token,
        //  'username'=> $data->username,
        //  'nik' => $data->employee->nik,
        //  'nama'=> $data->employee->nama,
        //  'branch'=> $data->userJobs[0]->userJobPK->idBranch,
        //  'job'=> $data->userJobs[0]->userJobPK->idJobs]);

        //palsu
 
         session(['token' => '1234567',
         'username'=> 'anisentus.yoseph@idn.ccb.com',
         'nik' => '17 3694',
         'nama'=> 'Yosep',
         'branch'=> 'ID0010028',
         'job'=> 'S0309']);

       // dd(session('username'),session('token'), session('nik'), session('nama'), session('branch'), session('job'));
       // dd(session('job'));
       // dd($data);
       $id_branch = session('branch');
       $flow = FlowMapping::where('id',$id_branch)->get();
        foreach($flow as $data)
        {
            $path = explode(';',$data->path);
            $countPath = count($path);
            for($i = 0; $i<$countPath;$i++){
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
                    echo "<script type='text/javascript'>alert('Non Jabodetabek');</script>";
                }
            }
            
        }

       
    //    $userBM = UserJob::where('id_branch',$id_branch)->get();
    //    $userAM = UserJob::where('id_branch','AR0012')->get();
    //    $userRH = UserJob::where('id_branch','AR0001')->get();
    //    $userDR = UserJob::where('id_branch','AR0001')->get();

       session(['bm'=>$userBM[0]->username,
       'am'=>$userAM[0]->username,
       'rh'=>$userRH[0]->username,
       'dr'=>$userDR]);

       return View('user-mapping-test',compact('token',
       'username',
       'nik',
       'nama',
       'branch',
       'job',
       'flow',
       'userBM','userAM','userRH','userDR','bm','am','rh','dr'
    ));
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
        $response = $client->DELETE('http://192.168.1.57:8015/login', ['json'=>['username'=>'harsya.mifta@idn.ccb.com','password'=>'asaasaasa']]);
 
         $data = $response->getBody();
         $data = json_decode($data);
         dd($data);

    }

}
