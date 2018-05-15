<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class EmployeeGuzzleController extends Controller
{
    public function saveApiData(){
        $client = new Client();
        $res = $client->request('POST','192.168.1.57:8015/login', [
            'form_params' => [
                'username' => 'harsya.mifta@idn.ccb.com',
                'password' => '18 3772',
            ]
        ]);
        echo $res->getStatusCode();
        // "200"
        echo $res->getHeader('content-type');
        // 'application/json; charset=utf8'
        echo $res->getBody();
        // {"type":"User"...')
    }
}
