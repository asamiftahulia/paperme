<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TimeDeposit;
use App\TD;
use App\MasterBank;
use App\M_branchs;
use App\SpecialRate;
use PDF;
use Session;
use Validator;
use App\Mail\PostSubscribtion;
use Mail;
use App\transaction_td;
use App\MasterSpecialRate;
use App\M_Tipe_Deposito;
use DB;
use App\FlowMapping;
use App\UserJob;
use App\TD_User;

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
        $data = TD::All();
      //  return view('time-deposit-list', compact('data'));
        $tdUser = TD_USER::All();
        $lengkap = DB::table('time-deposit')
            ->select('*')
            ->join('td_user', 'time-deposit.id', '=', 'td_user.id_td')
            ->where('time-deposit.status','!=','FINISH')
            ->orderBy('time-deposit.created_at','desc')
            ->get();
        $lengkapForBM = DB::table('time-deposit')
            ->select('*')
            ->join('td_user', 'time-deposit.id', '=', 'td_user.id_td')
            ->where('time-deposit.status','!=','FINISH')
            ->orderBy('time-deposit.created_at','asc')
            ->get();

            $query = 'SELECT * FROM "time-deposit" td JOIN td_user tu ON td.id = tu.id_td WHERE td.status = "ON PROGRESS" ORDER BY td.created_at = "asc"';
        $dataLengkapForBM = DB::raw($query);
        //dd($lengkap);
        return view('list-td',compact('data','trx','tdUser','lengkap','lengkapForBM','dataLengkapForBM'));
        //  dd($lengkapForBM);
        
    }

    public function indexFinish()
    {
        //
        $dataFinish = DB::table('time-deposit')->where('status', 'FINISH')->get();
        return view('list-td-finish',compact('dataFinish'));
        //  dd($lengkapForBM);
        
    }

    public function tabMenu(){
          $lengkapForBMSingle = DB::table('time-deposit')
              ->select('*')
              ->join('td_user', 'time-deposit.id', '=', 'td_user.id_td')
              ->where('time-deposit.status','!=','FINISH')
              ->whereNull('col')
              ->orderBy('time-deposit.created_at','asc')
              ->get();
            //   select DISTINCT(id_memmo) from "time-deposit" where col = 'col' order by id_memmo
            $idMemmo = TD::DISTINCT('id_memmo')
              ->where('status','!=','FINISH')
              ->where('col','=','col')
              ->orderBy('id_memmo','asc')
              ->get(['id_memmo','status']);

              $dataDetail = DB::table('time-deposit')
              ->select('*')
              ->join('td_user', 'time-deposit.id', '=', 'td_user.id_td')
              ->where('time-deposit.status','!=','FINISH')
              ->where('id_memmo','=','17')
              ->orderBy('time-deposit.created_at','asc')
              ->get();

           $lengkapForBMCol=TD::distinct('id_memmo')->get(['id_memmo','status']);

           $dataDetailCol = TD::where('id_memmo','=','17');
        return view('tab-menu-',compact('lengkapForBMSingle','lengkapForBMCol','idMemmo','dataDetail'));
        // dd($dataCol);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       // return view('time-deposit-form');
       //$banks= MasterBank::pluck('NAMA_BANK', 'KODE_LJK');
        $banks = MasterBank::all();
        $branch = m_branchs::all();
        $data = MasterSpecialRate::all();
        $lastID = TD::orderBy('id','desc')->first();
        return view('registrasi-td-form', compact('banks','branch','data', 'lastID'));
        // return view('registrasi-td-form');

    }

      public function summary()
    {
        //
        return view('dahboard');

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
        $data = new TD();
        $data->full_name = $request->full_name; 
        $strAmount = filter_var($request->amount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $data->amount = $strAmount;
        $str = ltrim($request->amount, ',');
        $str = trim($request->amount);
    
        $dt = strtotime($request->date_rollover);

        if($request->period==1)
            $expired = date("Y-m-d", strtotime("+1 month", $dt));
        else if($request->period==3)
            $expired = date("Y-m-d", strtotime("+3 month", $dt));
        else if($request->period==6)
            $expired = date("Y-m-d", strtotime("+6 month", $dt));
        else 
            $expired = date("Y-m-d", strtotime("+12 month", $dt));
        
        $data->status = 'ON PROGRESS';
        $data->notes = $request->notes;
        $data->expired_date = $expired;
        $data->period = $request->period;
        $data->currency = $request->currency;
        $data->type_of_td = $request->type_of_td;
        $data->id_memmo = $request->id_memmo;
        $data->bank = $request->bank;
        $data->date_rollover = $request->date_rollover;
        $data->special_rate = $request->special_rate;
        $data->normal_rate = $request->normal_rate;
        $data->id_branch = session('branch');
        $data->created_by = session('username');
        $data->updated_by = session('username');       
        //image
        if($request->hasfile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();
            $img = $request->image->move(public_path('images'), $fileName);
        }else{
            $fileName = 'No Photo';
        }
        
        // dd($fileName);
        $data->image = $fileName;
        $data->save();
        // Mail::to('harsya.mifta@idn.ccb.com')->send(new PostSubscribtion($data));
        return redirect('td/summary')->with('id',$data->id);
    }

    public function storeCol(Request $request)
    {
        //
        // $validatedData = $request->validate([
        // 'full_name' => 'required|max:3']);
        $validator = Validator::make($request->all(),[
            'full_name' => 'required',
            'amount' =>  'regex:/^\d*(\.\d{3})?$/',

        ]);
        $data = new TD();
        $data->full_name = $request->full_name; 
        $strAmount = filter_var($request->amount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $data->amount = $strAmount;
        $str = ltrim($request->amount, ',');
        $str = trim($request->amount);
    
        $dt = strtotime($request->date_rollover);

        if($request->period==1)
            $expired = date("Y-m-d", strtotime("+1 month", $dt));
        else if($request->period==3)
            $expired = date("Y-m-d", strtotime("+3 month", $dt));
        else if($request->period==6)
            $expired = date("Y-m-d", strtotime("+6 month", $dt));
        else 
            $expired = date("Y-m-d", strtotime("+12 month", $dt));
        $count = 0;
        $idMemo = $request->id_td."'asa'".$count;
        $data->status = 'ON PROGRESS';
        $data->notes = $request->notes;
        $data->expired_date = $expired;
        $data->period = $request->period;
        $data->currency = $request->currency;
        $data->type_of_td = $request->type_of_td;
        $data->bank = $request->bank;
        $data->date_rollover = $request->date_rollover;
        $data->special_rate = $request->special_rate;
        $data->normal_rate = $request->normal_rate;
        $data->id_branch = session('branch');
        $data->created_by = session('username');
        $data->updated_by = session('username');       
        //image
        if($request->hasfile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();
            $img = $request->image->move(public_path('images'), $fileName);
        }else{
            $fileName = 'No Photo';
        }
        
        // dd($fileName);
        $data->image = $fileName;
        $data->save();
        dd($idMemo);
        // Mail::to('harsyami@gmail.com')->send(new PostSubscribtion($data));
        // return redirect('td/summary')->with('id',$data->id);
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
        $id = session('id');
        $data = TD::where('id', $id)->get();
        $mSR = SpecialRate::all();
       
        $bm = 0;
        $am = 0;
        $rm = 0;
        $director = 0;
        $dataApprover = array(['Area Manager','Regional Head','Director']);
       
         
                foreach($data as $datas){
                    $currency = $datas['currency'];
                    $specialRate = $datas['special_rate'];
                    $period = $datas['period'];
                    $amount = $datas['amount'];
                    if($currency == 'IDR'){
                        if($period == 1){
                            // > i bio
                            if($amount > 1000000000){
                                if($specialRate >= 5.50 && $specialRate <= 6.25){
                                    $dataApprover = array('approver'=>'Area Manager');
                                }else if($specialRate >= 6.25 && $specialRate <= 6.75){
                                    $dataApprover = array('approver'=>'Area Manager','Regional Head');
                                }else if($specialRate > 6.75){
                                    $dataApprover = array('approver'=>'Area Manager','Regional Head','Director');
                                }
                            }else if($amount < 1000000000){
                                if($specialRate >= 5.50 && $specialRate <= 6.25){
                                    $dataApprover = array('approver'=>'Area Manager');
                                }else if($specialRate >= 6.25 && $specialRate <= 6.50){
                                    $dataApprover = array('approver'=>'Area Manager','Regional Head');
                                }else if($specialRate > 6.50){
                                    $dataApprover = array('approver'=>'Area Manager','Regional Head','Director');
                                }
                            }
                        }else if($period == 3 || $period == 6){
                            if($amount > 100000000){
                                if($specialRate >= 5.75 && $specialRate <= 6.50){
                                    $dataApprover = array('approver'=>'Area Manager');
                                }else if($specialRate > 6.50 && $specialRate <= 6.75){
                                    $dataApprover = array('approver'=>'Area Manager','Regional Head');
                                }else if($specialRate >6.75){
                                    $dataApprover = array('approver'=>'Area Manager','Regional Head','Director');
                                }
                            }
                        }else if($period == 12){
                            if($amount > 100000000){
                                if($specialRate >= 6.00 && $specialRate <= 6.50){
                                    $dataApprover = array('approver'=>'Area Manager');
                                }else if($specialRate > 6.50 && $specialRate <= 6.75){
                                    $dataApprover = array('approver'=>'Area Manager','Regional Head');
                                }else if($specialRate > 6.75){
                                    $dataApprover = array('approver'=>'Area Manager','Regional Head','Director');
                                }
                            }    
                        }
                    }else if($currency == 'USD'){
                        if($period == 1 || $period == 3 || $period == 6 || $period == 12){
                            if($amount > 100000000){
                                if($specialRate >= 0.50 && $specialRate <= 1.50){
                                    $dataApprover = array('approver'=>'Area Manager');
                                }else if($specialRate > 1.50 && $specialRate <= 1.75){
                                    $dataApprover = array('approver'=>'Area Manager','Regional Head');
                                }else if($specialRate > 1.75){
                                    $dataApprover = array('approver'=>'Area Manager','Regional Head','Director');
                                }
                            }    
                        }
                    }else if($currency == 'SGD'){
                        if($period == 1 || $period == 3 || $period == 6 || $period == 12){
                            if($amount > 100000000){
                                if($specialRate >= 0.50 && $specialRate <= 1.00){
                                    $dataApprover = array('approver'=>'Area Manager');
                                }else if($specialRate > 1.00 && $specialRate <= 1.25){
                                    $dataApprover = array('approver'=>'Area Manager','Regional Head');
                                }else if($specialRate > 1.25){
                                    $dataApprover = array('approver'=>'Area Manager','Regional Head','Director');
                                }
                            }    
                        }
                    }else if($currency == 'CNY'){
                        if($period == 1 || $period == 3 || $period == 6 || $period == 12){
                            if($amount > 100000000){
                                if($specialRate >= 0.50 && $specialRate <= 1.50){
                                    $dataApprover = array('approver'=>'Area Manager');
                                }else if($specialRate > 1.50 && $specialRate <= 2.00){
                                    $dataApprover = array('approver'=>'Area Manager','Regional Head');
                                }else if($specialRate > 2.00){
                                    $dataApprover = array('approver'=>'Area Manager','Regional Head','Director');
                                }
                            }    
                        }
                    }
                }

                // user bm
                $IdBranch = TD::where('id', $id)->get(['id_branch']);
                if($IdBranch!='NULL'){
                 // echo "<script type='text/javascript'>alert('$IdBranch[0]');</script>";
                 //get id branch
                 $branch = explode(':',$IdBranch[0]);
                 $cab =  substr( $branch[1], 1 );
                 $cabang= rtrim($cab, '"}');
                 // echo "<script type='text/javascript'>alert('$cabang');</script>";
                }else{
                 // echo "<script type='text/javascript'>alert('ga ada');</script>";
                }
                
                //get flow cabang
                $flow = FlowMapping::where('id',$cabang)->get();
         
                foreach($flow as $dataaa)
                 {
                     $cekJumlahApr = TD::where('id', $id)->get();
                     foreach($cekJumlahApr as $datas){
                         if($datas['currency'] == 'IDR'){
                             if($datas['period'] == 1){
                                 // > i bio
                                 if($datas['amount'] > 1000000000){
                                     if($datas['special_rate'] >= 5.50 && $data['special_rate'] <= 6.25){
                                         $dataApprover = array('approver'=>'AM');
                                         $jumlah = 2;
                                         $period = "1 & 3";
                                     }else if($datas['special_rate'] >= 6.25 && $datas['special_rate'] <= 6.75){
                                         $dataApprover = array('approver'=>'AM','Regional Head');
                                         $jumlah = 3;
                                         $period = "1 & 3";
                                     }else if($datas['special_rate'] > 6.75){
                                         $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                         $jumlah = 4;
                                         $period = "1 & 3";
                                     }
                                 }else if($datas['amount'] < 1000000000){
                                     if($datas['special_rate'] >= 5.50 && $datas['special_rate'] <= 6.25){
                                         $dataApprover = array('approver'=>'AM');
                                         $jumlah = 2;
                                         $period = "1 & 3";
                                     }else if($datas['special_rate'] >= 6.25 && $datas['special_rate'] <= 6.50){
                                         $dataApprover = array('approver'=>'AM','Regional Head');
                                         $jumlah = 3;
                                         $period = "1 & 3";
                                     }else if($datas['special_rate'] > 6.50){
                                         $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                         $jumlah = 4;
                                         $period = "1 & 3";
                                     }
                                 }
                             }else if($datas['period'] == 3 || $datas['period']== 6){
                                 if($datas['amount'] > 100000000){
                                     if($datas['special_rate'] >= 5.75 && $datas['special_rate'] <= 6.50){
                                         $dataApprover = array('approver'=>'AM');
                                         $jumlah = 2;
                                         $period = "1 & 3";
                                     }else if($datas['special_rate'] >= 6.50 && $datas['special_rate'] <= 6.75){
                                         $dataApprover = array('approver'=>'AM','Regional Head');
                                         $jumlah = 3;
                                         $period = "1 & 3";
                                     }else if($datas['special_rate'] > 6.75){
                                         $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                         $jumlah = 4;
                                         $period = "1 & 3";
                                     }
                                 }
                             }else if($datas['period'] == 12){
                                 if($datas['amount'] > 100000000){
                                     if($datas['special_rate'] >= 6.00 && $datas['special_rate'] <= 6.50){
                                         $dataApprover = array('approver'=>'AM');
                                         $jumlah = 2;
                                         $period = "1 & 3";
                                     }else if($datas['special_rate'] >= 6.50 && $datas['special_rate'] <= 6.75){
                                         $dataApprover = array('approver'=>'AM','Regional Head');
                                         $jumlah = 3;
                                         $period = "1 & 3";
                                     }else if($datas['special_rate'] > 6.75){
                                         $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                         $jumlah = 4;
                                         $period = "1 & 3";
                                     }
                                 }
                             }
                         }else if($datas['currency'] == 'USD'){
                             if($datas['period'] == 1 || $datas['period'] == 3 || $datas['period'] == 6 || $datas['period']==12){
                                 if($datas['special_rate'] >= 0.50 && $datas['special_rate'] <= 1.50){
                                     $dataApprover = array('approver'=>'AM');
                                     $jumlah = 2;
                                     $period = "1 & 3";
                                 }else if($datas['special_rate'] >= 1.50 && $datas['special_rate'] <= 1.75){
                                     $dataApprover = array('approver'=>'AM','Regional Head');
                                     $jumlah = 3;
                                     $period = "1 & 3";
                                 }else if($datas['special_rate'] > 1.75){
                                     $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                     $jumlah = 4;
                                     $period = "1 & 3";
                                 }
                             }
                         }else if($datas['currency'] == 'SGD'){
                             if($datas['period'] == 1 || $datas['period'] == 3 || $datas['period'] == 6 || $datas['period']==12){
                                 if($datas['special_rate'] >= 0.50 && $datas['special_rate'] <= 1.00){
                                     $dataApprover = array('approver'=>'AM');
                                     $jumlah = 2;
                                     $period = "1 & 3";
                                 }else if($datas['special_rate'] >= 1.00 && $datas['special_rate'] <= 1.25){
                                     $dataApprover = array('approver'=>'AM','Regional Head');
                                     $jumlah = 3;
                                     $period = "1 & 3";
                                 }else if($datas['special_rate'] > 1.25){
                                     $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                     $jumlah = 4;
                                     $period = "1 & 3";
                                 }
                             }
                         }else if($datas['currency']=='CNY'){
                             if($datas['period'] == 1 || $datas['period'] == 3 || $datas['period'] == 6 || $datas['period']==12){
                                 if($datas['special_rate'] >= 0.50 && $datas['special_rate'] <= 1.50){
                                     $dataApprover = array('approver'=>'AM');
                                     $jumlah = 2;
                                     $period = "1 & 3";
                                 }else if($datas['special_rate'] >= 1.50 && $datas['special_rate'] <= 2.00){
                                     $dataApprover = array('approver'=>'AM','Regional Head');
                                     $jumlah = 3;
                                     $period = "1 & 3";
                                 }else if($datas['special_rate'] > 2.00){
                                     $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                     $jumlah = 4;
                                     $period = "1 & 3";
                                 }
                             }
                         }
                     }
                         
                     $path = explode(';',$dataaa->path);
                     $countPath = count($path);
                     $regional = $dataaa->regional;
                   
                         $userBM = UserJob::where('id_branch',$cabang)->where('id_jobs','S0362')->get();
                         if($cabang=='ID0010037'){
                            $bmm = 'yulia.asnita@idn.ccb.com';
                         }else{
                         $bmm = $userBM[0]->username;
                         }
                        // echo "<script type='text/javascript'>alert('".$bmm."');</script>";

                 }
                //bmm
                //  echo "<script type='text/javascript'>alert('".$bmm."');</script>";
        Mail::to('harsya.mifta@idn.ccb.com')->send(new PostSubscribtion($data));
        return view('summary',compact('data', $data))->with('apr',$dataApprover);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = TD::where('id',$id)->get();
        $banks = MasterBank::all();
        $tipeDeps = M_Tipe_Deposito::all();
        return view('registrasi-td-form-edit',compact('data','banks','tipeDeps'));
    }

    public function renew($id)
    {
        $data = TD::where('id',$id)->get();
        $banks = MasterBank::all();
        $tipeDeps = M_Tipe_Deposito::all();
        return view('registrasi-td-form-renew',compact('data','banks','tipeDeps'));
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
        $data = TD::where('id',$id)->first();
        
        $data->full_name = $request->full_name;

        $strAmount = filter_var($request->amount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $data->amount = $strAmount;
        $str = ltrim($request->amount, ',');
        $str = trim($request->amount);
        $data->type_of_td = $request->type_of_td;
        $data->special_rate = $request->special_rate;
        $data->currency = $request->currency;
        $data->normal_rate = $request->normal_rate;

        $dt = strtotime($request->date_rollover);

        if($request->period==1)
            $expired = date("Y-m-d", strtotime("+1 month", $dt));
        else if($request->period==3)
            $expired = date("Y-m-d", strtotime("+3 month", $dt));
        else if($request->period==6)
            $expired = date("Y-m-d", strtotime("+6 month", $dt));
        else 
            $expired = date("Y-m-d", strtotime("+12 month", $dt));

        $data->expired_date = $expired;
        $data->date_rollover = $request->date_rollover;
        $data->period = $request->period;
        $data->notes = $request->notes;
        $data->save();

        return redirect('td/summary')->with('id',$data->id);
    }

    public function CreateRenew(Request $request)
    {
        $data = new TD();
        $data->full_name = $request->full_name; 
        $strAmount = filter_var($request->amount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $data->amount = $strAmount;
        $str = ltrim($request->amount, ',');
        $str = trim($request->amount);
    
        $dt = strtotime($request->date_rollover);

        if($request->period==1)
            $expired = date("Y-m-d", strtotime("+1 month", $dt));
        else if($request->period==3)
            $expired = date("Y-m-d", strtotime("+3 month", $dt));
        else if($request->period==6)
            $expired = date("Y-m-d", strtotime("+6 month", $dt));
        else 
            $expired = date("Y-m-d", strtotime("+12 month", $dt));
        
        $data->status = 'ON PROGRESS';
        $data->notes = $request->notes;
        $data->expired_date = $expired;
        $data->period = $request->period;
        $data->currency = $request->currency;
        $data->type_of_td = $request->type_of_td;
        $data->bank = $request->bank;
        $data->date_rollover = $request->date_rollover;
        $data->special_rate = $request->special_rate;
        $data->normal_rate = $request->normal_rate;
        $data->id_branch = session('branch');
        $data->created_by = session('username');
        $data->updated_by = session('username');       
        //image
        if($request->hasfile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();
            $img = $request->image->move(public_path('images'), $fileName);
        }else{
            $fileName = 'No Photo';
        }
        
        
        // dd($fileName);
        $data->image = $fileName;
        $data->save();
        Mail::to('harsyami@gmail.com')->send(new PostSubscribtion($data));
        return redirect('td/summary')->with('id',$data->id);
    }
    

    public function revisi(Request $request, $id)
    {
       // $data = TD::where('id',$id)->first();
        $data = TD::find($ids);
        
        $data->special_rate = $request->special_rate;
        $result = $data->save();

        if($result==1){
            echo "success";
            $notification = array(
                'message' => 'The Data Has Been Revised',
                'alert-type' => 'success'
            );
        }else if($result==0){
            echo "error";
            $notification = array(
                'message' => 'Error ! Can not Save Data',
                'alert-type' => 'error'
            );
        }

        return redirect('timeline/'.$data->id)->with($notification);
        
    }

    // public function updateStatus(Request $request, $id)
    // {
    //     $data = TD::where('id',$id)->first();
    //     $data->status = 'asa';
    //     $data->save();

    //     // echo $id;
    //     return redirect('timelines/'.$data->id)->with('id',$data->id);
        
    // }

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


    public function downloadSummary($id){
        $td = TD::find($id);
        $data = TD::where('id', $id)->get();    
        $trxTD = transaction_td::where('id_td', $id)->get();
        // dd($trxTD);
        

        $namaApprover = DB::table('time-deposit')
        ->select('*')
        ->join('td_user','time-deposit.id', '=', 'td_user.id_td')
        ->where('time-deposit.id','=',$id)
        ->get();

        $datalengkap = DB::table('trx-time-deposit')
        ->select('*')
        ->join('time-deposit', 'trx-time-deposit.id_td', '=', 'time-deposit.id')
        ->join('td_user','td_user.id_td','=','time-deposit.id')
        ->where('trx-time-deposit.aksi','=','Approve')
        ->where('trx-time-deposit.id_td','=',$id)
        ->get();
        // dd($datalengkap);
        $pdf = PDF::loadView('pdf-summary',compact('data',$data,'datalengkap',$datalengkap,'namaApprover',$namaApprover));
        $pdf->setPaper('A4','landscape');
        return $pdf->download('Summary_Time_Deposit_'.$data[0]->full_name.'.pdf');
    }

    
    public function cekApproved($id){
        $approverBM = DB::table('transaksi_td')->where('role', 'Branch Manager')->where('id_td',$id)->get();
    }

    

    public function timeline($id_td){
        
       $IdBranch = TD::where('id', $id_td)->get(['id_branch']);
       if($IdBranch!='NULL'){
        // echo "<script type='text/javascript'>alert('$IdBranch[0]');</script>";
        //get id branch
        $branch = explode(':',$IdBranch[0]);
        $cab =  substr( $branch[1], 1 );
        $cabang= rtrim($cab, '"}');
        // echo "<script type='text/javascript'>alert('$cabang');</script>";
       }else{
        // echo "<script type='text/javascript'>alert('ga ada');</script>";
       }
       
       //get flow cabang
       $flow = FlowMapping::where('id',$cabang)->get();

       foreach($flow as $data)
        {
            $cekJumlahApr = TD::where('id', $id_td)->get();
            foreach($cekJumlahApr as $datas){
                if($datas['currency'] == 'IDR'){
                    if($datas['period'] == 1){
                        // > i bio
                        if($datas['amount'] > 1000000000){
                            if($datas['special_rate'] >= 5.50 && $data['special_rate'] <= 6.25){
                                $dataApprover = array('approver'=>'AM');
                                $jumlah = 2;
                                $period = "1 & 3";
                            }else if($datas['special_rate'] >= 6.25 && $datas['special_rate'] <= 6.75){
                                $dataApprover = array('approver'=>'AM','Regional Head');
                                $jumlah = 3;
                                $period = "1 & 3";
                            }else if($datas['special_rate'] > 6.75){
                                $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                $jumlah = 4;
                                $period = "1 & 3";
                            }
                        }else if($datas['amount'] < 1000000000){
                            if($datas['special_rate'] >= 5.50 && $datas['special_rate'] <= 6.25){
                                $dataApprover = array('approver'=>'AM');
                                $jumlah = 2;
                                $period = "1 & 3";
                            }else if($datas['special_rate'] >= 6.25 && $datas['special_rate'] <= 6.50){
                                $dataApprover = array('approver'=>'AM','Regional Head');
                                $jumlah = 3;
                                $period = "1 & 3";
                            }else if($datas['special_rate'] > 6.50){
                                $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                $jumlah = 4;
                                $period = "1 & 3";
                            }
                        }
                    }else if($datas['period'] == 3 || $datas['period']== 6){
                        if($datas['amount'] > 100000000){
                            if($datas['special_rate'] >= 5.75 && $datas['special_rate'] <= 6.50){
                                $dataApprover = array('approver'=>'AM');
                                $jumlah = 2;
                                $period = "1 & 3";
                            }else if($datas['special_rate'] >= 6.50 && $datas['special_rate'] <= 6.75){
                                $dataApprover = array('approver'=>'AM','Regional Head');
                                $jumlah = 3;
                                $period = "1 & 3";
                            }else if($datas['special_rate'] > 6.75){
                                $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                $jumlah = 4;
                                $period = "1 & 3";
                            }
                        }
                    }else if($datas['period'] == 12){
                        if($datas['amount'] > 100000000){
                            if($datas['special_rate'] >= 6.00 && $datas['special_rate'] <= 6.50){
                                $dataApprover = array('approver'=>'AM');
                                $jumlah = 2;
                                $period = "1 & 3";
                            }else if($datas['special_rate'] >= 6.50 && $datas['special_rate'] <= 6.75){
                                $dataApprover = array('approver'=>'AM','Regional Head');
                                $jumlah = 3;
                                $period = "1 & 3";
                            }else if($datas['special_rate'] > 6.75){
                                $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                $jumlah = 4;
                                $period = "1 & 3";
                            }
                        }
                    }
                }else if($datas['currency'] == 'USD'){
                    if($datas['period'] == 1 || $datas['period'] == 3 || $datas['period'] == 6 || $datas['period']==12){
                        if($datas['special_rate'] >= 0.50 && $datas['special_rate'] <= 1.50){
                            $dataApprover = array('approver'=>'AM');
                            $jumlah = 2;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] >= 1.50 && $datas['special_rate'] <= 1.75){
                            $dataApprover = array('approver'=>'AM','Regional Head');
                            $jumlah = 3;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] > 1.75){
                            $dataApprover = array('approver'=>'AM','Regional Head','Director');
                            $jumlah = 4;
                            $period = "1 & 3";
                        }
                    }
                }else if($datas['currency'] == 'SGD'){
                    if($datas['period'] == 1 || $datas['period'] == 3 || $datas['period'] == 6 || $datas['period']==12){
                        if($datas['special_rate'] >= 0.50 && $datas['special_rate'] <= 1.00){
                            $dataApprover = array('approver'=>'AM');
                            $jumlah = 2;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] >= 1.00 && $datas['special_rate'] <= 1.25){
                            $dataApprover = array('approver'=>'AM','Regional Head');
                            $jumlah = 3;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] > 1.25){
                            $dataApprover = array('approver'=>'AM','Regional Head','Director');
                            $jumlah = 4;
                            $period = "1 & 3";
                        }
                    }
                }else if($datas['currency']=='CNY'){
                    if($datas['period'] == 1 || $datas['period'] == 3 || $datas['period'] == 6 || $datas['period']==12){
                        if($datas['special_rate'] >= 0.50 && $datas['special_rate'] <= 1.50){
                            $dataApprover = array('approver'=>'AM');
                            $jumlah = 2;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] >= 1.50 && $datas['special_rate'] <= 2.00){
                            $dataApprover = array('approver'=>'AM','Regional Head');
                            $jumlah = 3;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] > 2.00){
                            $dataApprover = array('approver'=>'AM','Regional Head','Director');
                            $jumlah = 4;
                            $period = "1 & 3";
                        }
                    }
                }
            }
                
            $path = explode(';',$data->path);
            $countPath = count($path);
            $regional = $data->regional;
            for($i = 0; $i<$countPath;$i++){
                if($countPath==4){
                    // echo "<script type='text/javascript'>alert('$path[$i]');</script>";
                    // echo'</br>';
                    $userBM = UserJob::where('id_branch',$cabang)->where('id_jobs','S0362')->get();
                    $userAM = UserJob::where('id_branch',$path[1])->where('id_jobs','S0465')->get();
                    $userRH = UserJob::where('id_branch',$path[2])->where('id_jobs','S0301')->get();
                    $userDR = "setiawati.samahita@idn.ccb.com";
                }elseif($countPath==3){
                    $userBM = UserJob::where('id_branch',$cabang)->where('id_jobs','S0465')->get();
                    $userAM = UserJob::where('id_branch',$cabang)->where('id_jobs','S0465')->get();
                    $userRH = UserJob::where('id_branch',$path[1])->where('id_jobs','S0301')->get();
                    $userDR = "setiawati.samahita@idn.ccb.com";
                    // echo "<script type='text/javascript'>alert('$path[$i]');</script>";
                }
            }
        }
        
            $cekTdUser = DB::table('td_user')->where('id_td', $id_td)->count();
            if($cekTdUser!=0){
                $cekRev = DB::table('trx-time-deposit')->where('id_td', $id_td)->where('aksi','Revisi')->count();
                if($cekRev!=0){
                    $cekRevisi = DB::table('trx-time-deposit')->where('id_td', $id_td)->where('aksi','Revisi')->get(['special_rate']);
                        foreach($cekRevisi as $c){                    
                            $rev = explode(':', $c->special_rate);
                            $countRev = count($rev);
                            $count = $countRev-1;
                            for($i = 0; $i<$countRev;$i++){
                                // echo "<script type='text/javascript'>alert('$rev[$i]');</script>";
                            }
                        }
                    //  dd($rev[$count]);
                     //get data sr dan currency dan period untuk dapat tau jumlah approver
                     $sr = DB::table('time-deposit')->where('id', $id_td)->get(['period','currency','special_rate']);
                        // dd($sr[0]->period);
                        foreach($cekJumlahApr as $datas){
                            if($sr[0]->currency == 'IDR'){
                                if($sr[0]->period == 1 || $sr[0]->period == 3){
                                    if($sr[0]->special_rate == '5.50' || $sr[0]->special_rate <= '6.25'){
                                        $dataApprover = array('approver'=>'AM');
                                        $jumlah = 2;
                                        $period = "1 & 3";
                                    }else if($sr[0]->special_rate == '6.25' || $sr[0]->special_rate <= '6.50'){
                                        $dataApprover = array('approver'=>'AM','Regional Head');
                                        $jumlah = 3;
                                        $period = "1 & 3";
                                    }else if($sr[0]->special_rate > '6.50'){
                                        $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                        $jumlah = 4;
                                        $period = "1 & 3";
                                    }else{
                                        echo 'Approver Not Found';
                                    }
                                }else if($sr[0]->period == 6 || $sr[0]->period == 12){
                                    if($sr[0]->special_rate == '5.50' || $sr[0]->special_rate <= '5.75'){
                                        $dataApprover = array('approver'=>'AM');
                                        $jumlah = 2;
                                        $period = "6 & 12";
                                    }else if($sr[0]->special_rate == '5.50' || $sr[0]->special_rate <= '6.00'){
                                        $dataApprover = array('approver'=>'AM','Regional Head');
                                        $jumlah = 3;
                                        $period = "6 & 12";
                                    }else if($sr[0]->special_rate == '5.50' || $sr[0]->special_rate > '6.00'){
                                        $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                        $jumlah = 4;
                                        $period = "6 & 12";
                                    }else{
                                        echo 'Approver Not Found';
                                    }
                                }
                            }elseif($sr[0]->currency=='USD'){
                                 $period = "All Period";
                                if($sr[0]->special_rate == '0.50' || $sr[0]->special_rate <= '1.00'){
                                    $dataApprover = array('approver'=>'AM');
                                    $jumlah = 2;
                                   
                                }else if($sr[0]->special_rate == '1.00' || $sr[0]->special_rate <= '1.25'){
                                    $dataApprover = array('approver'=>'AM','Regional Head');
                                    $jumlah = 3;
                                }else if($sr[0]->special_rate > '1.25'){
                                    $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                    $jumlah = 4;
                                }else{
                                    echo 'Approver Not Found';
                                }
                            }elseif($sr[0]->currency=='SGD'){
                                $period = "All Period";
                                if($sr[0]->special_rate == '0.50' || $sr[0]->special_rate <= '0.75'){
                                    $dataApprover = array('approver'=>'AM');
                                    $jumlah = 2;
                                }else if($sr[0]->special_rate == '0.75' || $sr[0]->special_rate <= '1.00'){
                                    $dataApprover = array('approver'=>'AM','Regional Head');
                                    $jumlah = 3;
                                }else if($sr[0]->special_rate > '1.00'){
                                    $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                    $jumlah = 4;
                                }else{
                                    echo 'Approver Not Found';
                                }
                            }elseif($sr[0]->currency=='CNY'){
                                $period = "All Period";
                                if($sr[0]->special_rate == '0.50' || $sr[0]->special_rate <= '1.25'){
                                    $dataApprover = array('approver'=>'AM');
                                    $jumlah = 2;
                                }else if($sr[0]->special_rate == '1.25' || $sr[0]->special_rate <= '1.50'){
                                    $dataApprover = array('approver'=>'AM','Regional Head');
                                    $jumlah = 3;
                                }else if($sr[0]->special_rate > '1.50'){
                                    $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                    $jumlah = 4;
                                }else{
                                    echo 'Approver Not Found';
                                }
                            }
                        }
                        // dd($jumlah);
                        // $ganti = DB::table('td_user')->where('id_td', $id_td)->update(['jumlah' => $jumlah]);
                        $td = TD::find($id_td);
                        $cekApproverKeBerapa = TD_USER::where('id_td', $id_td)->get(['bm','am','rh','dr']);
                        $x = 'asa';
                        $ApproverKe = 0;
                        $login = session('username');
                        foreach($cekApproverKeBerapa as $a){
                            if($a->bm == $login){
                                // echo "bm";
                                $ApproverKe = 1;
                            }elseif($a->am == $login){
                                // echo "am";
                                $ApproverKe = 2;
                            }elseif($a->rh == $login){
                                // echo "rh";
                                $ApproverKe = 3;
                            }else{
                                // echo "dr";
                                $ApproverKe = 4;
                            }
                        }
                        
                        $approverTd = $td->approver;
                        
                        // echo "<script type='text/javascript'>alert($td->approver);</script>";
                        if(($jumlah < $approverTd) && ($approverTd == $ApproverKe) && (session('job')!='S0362')){
                            // echo "<script type='text/javascript'>alert('gabole');</script>";
                            // echo "<script type='text/javascript'>alert($td->approver);</script>";
                            $apr = $td->approver;
                            $ganti = DB::table('td_user')->where('id_td', $id_td)->update(['jumlah' => $td->approver]);
                            $gantiTD = DB::table('time-deposit')->where('id', $id_td)->update(['approver' => $td->approver]);
                            

                        }else{
                            // echo "<script type='text/javascript'>alert($jumlah);</script>";
                            $ganti = DB::table('time-deposit')->where('id', $id_td)->update(['approver' => $jumlah]);
                            $revisiRH = 0;
                            // echo "<script type='text/javascript'>alert($ganti);</script>";
                        }
                        // dd($ganti);
                     //echo "<script type='text/javascript'>alert('$cekRevisi[0]');</script>";
                }
                // else{
                //     echo "<script type='text/javascript'>alert('ga ada revisi');</script>";
                // }
            }else{
                //insert td user 
                $td_user = new TD_USER();
                $td_user->id_td = $id_td;
                $td_user->bm = $userBM[0]->username;
                $td_user->am = $userAM[0]->username;
                $td_user->rh = $userRH[0]->username;
                $td_user->dr = 'setiawati.samahita@idn.ccb.com';
                $td_user->region = $regional;
                $td_user->jumlah = $jumlah;
                $td_user->save();
                
                $td = TD::find($id_td);
                $td->approver = $td_user->jumlah;
                $td->save();

            }
         
          $data = TD::where('id', $id_td)->get();
        
            
       // $data = transaction_td::where('id_td', $id)->get();
          $approverBM = DB::table('trx-time-deposit')->where('role', 'Branch Manager')->where('id_td',$id_td)->where('aksi','Approve')->count();
          $approverAM = DB::table('trx-time-deposit')->where('role', 'Area Manager')->where('id_td',$id_td)->where('aksi','Approve')->count();
          $approverRH = DB::table('trx-time-deposit')->where('role', 'Regional Head')->where('id_td',$id_td)->where('aksi','Approve')->count();
          $approverDR = DB::table('trx-time-deposit')->where('role', 'Director')->where('id_td',$id_td)->where('aksi','Approve')->count();
          
          $rejectBM = DB::table('trx-time-deposit')->where('role', 'Branch Manager')->where('id_td',$id_td)->where('aksi','Reject')->count();
          $rejectAM = DB::table('trx-time-deposit')->where('role', 'Area Manager')->where('id_td',$id_td)->where('aksi','Reject')->count();
          $rejectRH = DB::table('trx-time-deposit')->where('role', 'Regional Head')->where('id_td',$id_td)->where('aksi','Reject')->count();
          $rejectDR = DB::table('trx-time-deposit')->where('role', 'Director')->where('id_td',$id_td)->where('aksi','Reject')->count();

          //revisi
          $revisiRH = DB::table('trx-time-deposit')->where('role', 'Regional Head')->where('id_td',$id_td)->where('aksi','Revisi')->count();
          $revisiDR = DB::table('trx-time-deposit')->where('role', 'Director')->where('id_td',$id_td)->where('aksi','Revisi')->count();
          foreach($data as $datas){
            if($datas['currency'] == 'IDR'){
                if($datas['period'] == 1){
                    if($datas['amount'] > 100000000 || $datas['amount'] <= 1000000000){
                        if($datas['special_rate'] == '5.50' || $datas['special_rate'] <= '6.25'){
                            $dataApprover = array('approver'=>'AM');
                            $apr = 2;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] == '6.25' || $datas['special_rate'] <= '6.50'){
                            $dataApprover = array('approver'=>'AM','Regional Head');
                            $apr = 3;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] > '6.50'){
                            $dataApprover = array('approver'=>'AM','Regional Head','Director');
                            $apr = 4;
                            $period = "1 & 3";
                        }else{
                            echo 'Approver Not Found';
                        }
                    }else if($datas['amount'] > 1000000000){
                        if($datas['special_rate'] == '5.50' || $datas['special_rate'] <= '6.25'){
                            $dataApprover = array('approver'=>'AM');
                            $apr = 2;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] == '6.25' || $datas['special_rate'] <= '6.75'){
                            $dataApprover = array('approver'=>'AM','Regional Head');
                            $apr = 3;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] > '6.75'){
                            $dataApprover = array('approver'=>'AM','Regional Head','Director');
                            $apr = 4;
                            $period = "1 & 3";
                        }else{
                            echo 'Approver Not Found';
                        }
                    }
                }else if($datas['period'] == 3 || $datas['period'] == 6){
                    if($datas['special_rate'] == '5.75' || $datas['special_rate'] <= '6.50'){
                        $dataApprover = array('approver'=>'AM');
                        $apr = 2;
                        $period = "6 & 12";
                    }else if($datas['special_rate'] == '6.50' || $datas['special_rate'] <= '6.75'){
                        $dataApprover = array('approver'=>'AM','Regional Head');
                        $apr = 3;
                        $period = "6 & 12";
                    }else if($datas['special_rate'] > '6.75'){
                        $dataApprover = array('approver'=>'AM','Regional Head','Director');
                        $apr = 4;
                        $period = "6 & 12";
                    }else{
                        echo 'Approver Not Found';
                    }
                }else if($datas['period'] == 12){
                    if($datas['special_rate'] == '6.00' || $datas['special_rate'] <= '6.50'){
                        $dataApprover = array('approver'=>'AM');
                        $apr = 2;
                        $period = "6 & 12";
                    }else if($datas['special_rate'] == '6.50' || $datas['special_rate'] <= '6.75'){
                        $dataApprover = array('approver'=>'AM','Regional Head');
                        $apr = 3;
                        $period = "6 & 12";
                    }else if($datas['special_rate'] > '6.75'){
                        $dataApprover = array('approver'=>'AM','Regional Head','Director');
                        $apr = 4;
                        $period = "6 & 12";
                    }else{
                        echo 'Approver Not Found';
                    }
                }
            }elseif($datas['currency']=='USD'){
                 $period = "All Period";
                if($datas['special_rate'] == '0.50' || $datas['special_rate'] <= '1.50'){
                    $dataApprover = array('approver'=>'AM');
                    $apr = 2;
                   
                }else if($datas['special_rate'] == '1.50' || $datas['special_rate'] <= '1.75'){
                    $dataApprover = array('approver'=>'AM','Regional Head');
                    $apr = 3;
                }else if($datas['special_rate'] > '1.75'){
                    $dataApprover = array('approver'=>'AM','Regional Head','Director');
                    $apr = 4;
                }else{
                    echo 'Approver Not Found';
                }
            }elseif($datas['currency']=='SGD'){
                $period = "All Period";
                if($datas['special_rate'] == '0.50' || $datas['special_rate'] <= '1.00'){
                    $dataApprover = array('approver'=>'AM');
                    $apr = 2;
                }else if($datas['special_rate'] == '1.00' || $datas['special_rate'] <= '1.25'){
                    $dataApprover = array('approver'=>'AM','Regional Head');
                    $apr = 3;
                }else if($datas['special_rate'] > '1.25'){
                    $dataApprover = array('approver'=>'AM','Regional Head','Director');
                    $apr = 4;
                }else{
                    echo 'Approver Not Found';
                }
            }elseif($datas['currency']=='CNY'){
                $period = "All Period";
                if($datas['special_rate'] == '0.50' || $datas['special_rate'] <= '1.50'){
                    $dataApprover = array('approver'=>'AM');
                    $apr = 2;
                }else if($datas['special_rate'] == '1.50' || $datas['special_rate'] <= '2.00'){
                    $dataApprover = array('approver'=>'AM','Regional Head');
                    $apr = 3;
                }else if($datas['special_rate'] > '2.00'){
                    $dataApprover = array('approver'=>'AM','Regional Head','Director');
                    $apr = 4;
                }else{
                    echo 'Approver Not Found';
                }
            }
        }

        $trx = transaction_td::where('id_td',$id_td)->count();
        //untuk ditampilin yang revisi dan menghilangkan diri sendiri
        $rev = transaction_td::where('id_td',$id_td)->where('trx-time-deposit.aksi','Revisi')->orderBy('created_at','desc')->limit(1)
        ->get(['special_rate','created_at']);
        $user = TD_USER::where('id_td',$id_td)->get();
        //dd($approverBM);
        if($trx == $apr)
            $valButton = 1;
        else 
            $valButton = 1;
            // dd($user);
        
            $strApr = "Approve";
            $strStatus = "FINISH";
        $checkApproved = transaction_td::where('id_td', $id_td)->where('aksi',$strApr)->count();
        $approver = TD::where('id', $id_td)->pluck('approver')->first();
        $status = TD::where('id', $id_td)
        ->where('status', $strStatus)
        ->pluck('approver')->first();
        // dd($checkApproved);
        // dd($approver);

       
        // echo "<script type='text/javascript'>alert(".$td->approver.");</script>"; 
        if($checkApproved == $approver){
            $td = TD::find($id_td);
            $td->status = $strStatus;
            $td->save();
        }

        $trxDetail =DB::table('trx-time-deposit')
        ->select('*')
        ->where('id_td','=',$id_td)
        ->get();
        // dd($trxDetail);

        if($revisiRH == 5){
            // echo "<script type='text/javascript'>alert('satu');</script>"; 
            $apr = $td->approver;
        }else{
            // echo "<script type='text/javascript'>alert('ga');</script>"; 
        }
        return view('timeline-td',compact('data',$data))->with('apr',$dataApprover)
        ->with('user',$user)
        ->with('rev',$rev)
        ->with('trxDetail',$trxDetail)
        ->with('valButton',$valButton)
        ->with('trx',$trx)
        ->with('jumlahApr',$apr)
        ->with('approverBM',$approverBM)
        ->with('approverAM', $approverAM)
        ->with('approverRH', $approverRH)
        ->with('approverDR', $approverDR)
        ->with('period',$period)
        ->with('rejectBM',$rejectBM)
        ->with('rejectAM', $rejectAM)
        ->with('rejectRH', $rejectRH)
        ->with('rejectDR', $rejectDR)
        ->with('revisiRH', $revisiRH)
        ->with('revisiDR', $revisiDR)
        ->with('checkApproved', $checkApproved)
        ->with('approver',$approver)
        ->with('status',$status);
        // bikin yg revisi juga
        
    }

    public function insertTdUserForCollectiveTDNew($id_td){
        $IdBranch = TD::where('id', $id_td)->get(['id_branch']);
       if($IdBranch!='NULL'){
        // echo "<script type='text/javascript'>alert('$IdBranch[0]');</script>";
        //get id branch
        $branch = explode(':',$IdBranch[0]);
        $cab =  substr( $branch[1], 1 );
        $cabang= rtrim($cab, '"}');
        // echo "<script type='text/javascript'>alert('$cabang');</script>";
       }else{
        // echo "<script type='text/javascript'>alert('ga ada');</script>";
       }
        //get flow cabang
       $flow = FlowMapping::where('id',$cabang)->get();

       foreach($flow as $data)
        {
            $cekJumlahApr = TD::where('id', $id_td)->get();
            foreach($cekJumlahApr as $datas){
                if($datas['currency'] == 'IDR'){
                    if($datas['period'] == 1){
                        // > i bio
                        if($datas['amount'] > 1000000000){
                            if($datas['special_rate'] >= 5.50 && $data['special_rate'] <= 6.25){
                                $dataApprover = array('approver'=>'AM');
                                $jumlah = 2;
                                $period = "1 & 3";
                            }else if($datas['special_rate'] >= 6.25 && $datas['special_rate'] <= 6.75){
                                $dataApprover = array('approver'=>'AM','Regional Head');
                                $jumlah = 3;
                                $period = "1 & 3";
                            }else if($datas['special_rate'] > 6.75){
                                $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                $jumlah = 4;
                                $period = "1 & 3";
                            }
                        }else if($datas['amount'] < 1000000000){
                            if($datas['special_rate'] >= 5.50 && $datas['special_rate'] <= 6.25){
                                $dataApprover = array('approver'=>'AM');
                                $jumlah = 2;
                                $period = "1 & 3";
                            }else if($datas['special_rate'] >= 6.25 && $datas['special_rate'] <= 6.50){
                                $dataApprover = array('approver'=>'AM','Regional Head');
                                $jumlah = 3;
                                $period = "1 & 3";
                            }else if($datas['special_rate'] > 6.50){
                                $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                $jumlah = 4;
                                $period = "1 & 3";
                            }
                        }
                    }else if($datas['period'] == 3 || $datas['period']== 6){
                        if($datas['amount'] > 100000000){
                            if($datas['special_rate'] >= 5.75 && $datas['special_rate'] <= 6.50){
                                $dataApprover = array('approver'=>'AM');
                                $jumlah = 2;
                                $period = "1 & 3";
                            }else if($datas['special_rate'] >= 6.50 && $datas['special_rate'] <= 6.75){
                                $dataApprover = array('approver'=>'AM','Regional Head');
                                $jumlah = 3;
                                $period = "1 & 3";
                            }else if($datas['special_rate'] > 6.75){
                                $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                $jumlah = 4;
                                $period = "1 & 3";
                            }
                        }
                    }else if($datas['period'] == 12){
                        if($datas['amount'] > 100000000){
                            if($datas['special_rate'] >= 6.00 && $datas['special_rate'] <= 6.50){
                                $dataApprover = array('approver'=>'AM');
                                $jumlah = 2;
                                $period = "1 & 3";
                            }else if($datas['special_rate'] >= 6.50 && $datas['special_rate'] <= 6.75){
                                $dataApprover = array('approver'=>'AM','Regional Head');
                                $jumlah = 3;
                                $period = "1 & 3";
                            }else if($datas['special_rate'] > 6.75){
                                $dataApprover = array('approver'=>'AM','Regional Head','Director');
                                $jumlah = 4;
                                $period = "1 & 3";
                            }
                        }
                    }
                }else if($datas['currency'] == 'USD'){
                    if($datas['period'] == 1 || $datas['period'] == 3 || $datas['period'] == 6 || $datas['period']==12){
                        if($datas['special_rate'] >= 0.50 && $datas['special_rate'] <= 1.50){
                            $dataApprover = array('approver'=>'AM');
                            $jumlah = 2;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] >= 1.50 && $datas['special_rate'] <= 1.75){
                            $dataApprover = array('approver'=>'AM','Regional Head');
                            $jumlah = 3;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] > 1.75){
                            $dataApprover = array('approver'=>'AM','Regional Head','Director');
                            $jumlah = 4;
                            $period = "1 & 3";
                        }
                    }
                }else if($datas['currency'] == 'SGD'){
                    if($datas['period'] == 1 || $datas['period'] == 3 || $datas['period'] == 6 || $datas['period']==12){
                        if($datas['special_rate'] >= 0.50 && $datas['special_rate'] <= 1.00){
                            $dataApprover = array('approver'=>'AM');
                            $jumlah = 2;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] >= 1.00 && $datas['special_rate'] <= 1.25){
                            $dataApprover = array('approver'=>'AM','Regional Head');
                            $jumlah = 3;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] > 1.25){
                            $dataApprover = array('approver'=>'AM','Regional Head','Director');
                            $jumlah = 4;
                            $period = "1 & 3";
                        }
                    }
                }else if($datas['currency']=='CNY'){
                    if($datas['period'] == 1 || $datas['period'] == 3 || $datas['period'] == 6 || $datas['period']==12){
                        if($datas['special_rate'] >= 0.50 && $datas['special_rate'] <= 1.50){
                            $dataApprover = array('approver'=>'AM');
                            $jumlah = 2;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] >= 1.50 && $datas['special_rate'] <= 2.00){
                            $dataApprover = array('approver'=>'AM','Regional Head');
                            $jumlah = 3;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] > 2.00){
                            $dataApprover = array('approver'=>'AM','Regional Head','Director');
                            $jumlah = 4;
                            $period = "1 & 3";
                        }
                    }
                }
            }
            
            $path = explode(';',$data->path);
            $countPath = count($path);
            $regional = $data->regional;
            for($i = 0; $i<$countPath;$i++){
                if($countPath==4){
                    // echo "<script type='text/javascript'>alert('$path[$i]');</script>";
                    // echo'</br>';
                    $userBM = UserJob::where('id_branch',$cabang)->where('id_jobs','S0362')->get();
                    $userAM = UserJob::where('id_branch',$path[1])->where('id_jobs','S0465')->get();
                    $userRH = UserJob::where('id_branch',$path[2])->where('id_jobs','S0301')->get();
                    $userDR = "setiawati.samahita@idn.ccb.com";
                }elseif($countPath==3){
                    $userBM = UserJob::where('id_branch',$cabang)->where('id_jobs','S0465')->get();
                    $userAM = UserJob::where('id_branch',$cabang)->where('id_jobs','S0465')->get();
                    $userRH = UserJob::where('id_branch',$path[1])->where('id_jobs','S0301')->get();
                    $userDR = "setiawati.samahita@idn.ccb.com";
                    // echo "<script type='text/javascript'>alert('$path[$i]');</script>";
                }
            }
        }
        
                $td_user = new TD_USER();
                $td_user->id_td = $id_td;
                $td_user->bm = $userBM[0]->username;
                $td_user->am = $userAM[0]->username;
                $td_user->rh = $userRH[0]->username;
                $td_user->dr = 'setiawati.samahita@idn.ccb.com';
                $td_user->region = $regional;
                $td_user->jumlah = $jumlah;
                $td_user->save();
                
                $td = TD::find($id_td);
                $td->approver = $td_user->jumlah;
                $td->col = 'col';
                $td->save();
        
        $lastIDMemo =  TD::orderBy('id', 'desc')->first();
        $lastIDTd =  TD::orderBy('id', 'desc')->first();
        $banks = MasterBank::all();
        $branch = m_branchs::all();
        $data = MasterSpecialRate::all();

       
    //  dd($branch);
        return view('registrasi-td-form-col', compact('banks','branch','data','lastIDMemo', 'lastIDTd'));
    }

    // public function CollectiveInsert(){
        
    //     $data = array(
    //         array('user_id'=>'Coder 1', 'subject_id'=> 4096),
    //         array('user_id'=>'Coder 2', 'subject_id'=> 2048)
    //     );

    //     $td = TD::insert($data); // Eloquent approach
    //     DB::table('TD')->insert($data); // Query Builder approach
    // }

        // public function CollectiveInsert(Request $request)
        // {
        //     //
        //     // $validatedData = $request->validate([
        //     // 'full_name' => 'required|max:3']);
        //     $validator = Validator::make($request->all(),[
        //         'full_name' => 'required',
        //         'amount' =>  'regex:/^\d*(\.\d{3})?$/',
    
        //     ]);
        //     $data = new TD();
        //     $data->full_name = $request->full_name; 
        //     $strAmount = filter_var($request->amount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        //     $data->amount = $strAmount;
        //     $str = ltrim($request->amount, ',');
        //     $str = trim($request->amount);
        
        //     $dt = strtotime($request->date_rollover);
    
        //     if($request->period==1)
        //         $expired = date("Y-m-d", strtotime("+1 month", $dt));
        //     else if($request->period==3)
        //         $expired = date("Y-m-d", strtotime("+3 month", $dt));
        //     else if($request->period==6)
        //         $expired = date("Y-m-d", strtotime("+6 month", $dt));
        //     else 
        //         $expired = date("Y-m-d", strtotime("+12 month", $dt));
            
        //     $data->status = 'CREATED';
        //     $data->notes = $request->notes;
        //     $data->expired_date = $expired;
        //     $data->period = $request->period;
        //     $data->currency = $request->currency;
        //     $data->type_of_td = $request->type_of_td;
        //     $data->bank = $request->bank;
        //     $data->date_rollover = $request->date_rollover;
        //     $data->special_rate = $request->special_rate;
        //     $data->normal_rate = $request->normal_rate;
        //     $data->id_branch = session('branch');
        //     $data->created_by = session('username');
        //     $data->updated_by = session('username');       
        //     //image
        //     if($request->hasfile('image')){
        //         $file = $request->file('image');
        //         $ext = $file->getClientOriginalExtension();
        //         $fileName = $file->getClientOriginalName();
        //         $img = $request->image->move(public_path('images'), $fileName);
        //     }else{
        //         $fileName = 'No Photo';
        //     }
            
        //     // dd($fileName);
        //     $data->image = $fileName;
        //     $data->save();
        //     Mail::to('harsyami@gmail.com')->send(new PostSubscribtion($data));
        //     return redirect('td/summary')->with('id',$data->id);
        // }
    
}
