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
        $result = $this->client->post('http://192.168.1.57:8015/login', array(
            'json' => array(
                'username' => 'harsya.mifta@idn.ccb.com',
                'password' => '18 3772'
            )
            ));
        //    $client = new Client([
    //        'headers'=>['content-type'=>'application/json','Accept'=>'application/json'],
    //    ]);
    //    $response = $client->request('POST','http://192.168.1.57:8015/login',
    //    ["{'username'=>'harsya.mifta@idn.ccb.com',
    //        'password'=>'18 3772'
    //    }"]);
    //     $data = $response->getBody();
    //     $data = json_decode($data);
    //     dd($data);
        
    }

}
