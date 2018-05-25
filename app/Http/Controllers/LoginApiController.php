<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use View;
use Session;

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
     
        
       $response = $client->post('http://192.168.1.57:8015/login', ['json'=>['username'=>'harsya.mifta@idn.ccb.com','password'=>'asaasaasa']]);

        $data = $response->getBody();

        $data = json_decode($data);
        // dd($data->token);
       // dd($data->username,$data->token);
       // $token = $data->token;
       
        // session(['token' => $data->token, 'username'=> $data->username, 'nik' => $data->employee->nik, 'nama'=>$data->employee->nama]);
        // dd(session('username'),session('token'), session('nik'), session('nama'));
        
        dd($data);
       return View::make('yeay',compact('token','username'));
    }

    public function logout(){
        $client = new Client([
            'headers'=>['content-type'=>'application/json','X-Auth-Token'=>session('token')],
         ]);
      
         
        $response = $client->DELETE('http://192.168.1.57:8015/login', ['json'=>['username'=>'harsya.mifta@idn.ccb.com','password'=>'asaasaasa']]);
 
         $data = $response->getBody();
         $data = json_decode($data);
         dd($data);
    }

}
