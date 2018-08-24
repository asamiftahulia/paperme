<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TimeDeposit;
use App\TD;
use App\MasterBank;
use App\M_branchs;
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

class TDCollectiveController extends Controller
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
            ->orderBy('time-deposit.created_at','desc')
            ->get();
        $lengkapForBM = DB::table('time-deposit')
            ->select('*')
            ->join('td_user', 'time-deposit.id', '=', 'td_user.id_td')
            ->orderBy('time-deposit.created_at','asc')
            ->get();

            $query = 'SELECT * FROM "time-deposit" td JOIN td_user tu ON td.id = tu.id_td WHERE td.status = "ON PROGRESS" ORDER BY td.created_at = "asc"';
        $dataLengkapForBM = DB::raw($query);
        //dd($lengkap);
        return view('list-td-col',compact('data','trx','tdUser','lengkap','lengkapForBM','dataLengkapForBM'));
        //  dd($lengkapForBM);
    }

    public function getRequest(Request $request){
        if($request->ajax()){
            $counter = $request->counter;
            for($i = 1; $i<=$counter; $i++){
                $dataName = 'name'.$i;
                $dataEmail = 'email'.$i;
                $dataCheckApr = 'checkApr'.$i;

                $datasName[$i] = $request->$dataName;
                $datasEmail[$i] = $request->$dataEmail;
                $datasCheckApr[$i] = $request->$dataCheckApr;

                echo $datasName[$i].' ';
                echo $datasEmail[$i].' ';
                echo $datasCheckApr[$i].' ';
                echo "</br>";
            }

          }else{
            return dd(response()->json(['status' => 'error']));
          }
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
        // ke halaman summary collective, dan mengambil id memo
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
        $data->bank = $request->bank;
        $data->date_rollover = $request->date_rollover;
        $data->special_rate = $request->special_rate;
        $data->normal_rate = $request->normal_rate;
        $data->id_memmo = $request->id_memmo;
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
        return redirect('tdc/summaryCol')->with('id',$data->id_memmo);
    }

    public function timelineCollective($id_memmo){
        $data = TD::where('id_memmo',$id_memmo)->get();
        //ambil approvernya aja
      
        // for()
        //ambil id terakhir guna untuk update colom col diisi dengan 'col'
        $id_td = TD::where('id_memmo',$id_memmo)->orderBy('id','desc')->get()->first();
        $id = $id_td->id;
     
        //insert td user
        $IdBranch = TD::where('id', $id)->get(['id_branch']);
        if($IdBranch!='NULL'){
        //  echo "<script type='text/javascript'>alert('aaa');</script>";
            $branch = explode(':',$IdBranch[0]);
            $cab =  substr( $branch[1], 1 );
            $cabang= rtrim($cab, '"}');
        }else{
        
        }
        $flow = FlowMapping::where('id',$cabang)->get();
        foreach($flow as $dataa)
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
            
            $path = explode(';',$dataa->path);
            $countPath = count($path);
            $regional = $dataa->regional;
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

                $arrJumlah = [];
        
                $td = TD::find($id);
                $td->col = 'col';
                $td->save();
            //insert flag 'col' pada data yg terakhir dimasukan
            $td = TD::find($id);
            $td->col = 'col';
            $td->save();
            $string =[];
            $cekIdTdDiUser = DB::table('td_user')->where('id_td', $id)->pluck('id_td')->all();
            // dd($cekIdTdDiUser,$string);
            $maxAprover = TD::where('id_memmo', $id_memmo)->pluck('approver')->all();
            $maksApprover = max($maxAprover);
            // dd(max($maxAprover));
            $allData = DB::table('time-deposit')
            ->select('*')
            ->join('td_user', 'time-deposit.id', '=', 'td_user.id_td')
            ->where('time-deposit.id_memmo',$id_memmo)
            ->where('time-deposit.approver',$maksApprover)
            ->get();

            $statusAksiBM = DB::table('trx-time-deposit')->where('id_td', $id)->where('role','Branch Manager')->pluck('aksi')->all();

            

        $statusPengajuanBM = DB::table('trx-time-deposit')
        ->select('*')
        ->join('time-deposit', 'trx-time-deposit.id_td', '=', 'time-deposit.id')
        ->where('time-deposit.id_memmo',$id_memmo)
        ->where('role','Branch Manager')
        ->pluck('aksi');
        
        // dd($statusPengajuanBM);
       
        if($statusPengajuanBM!=$string){
            $tempStatusBM = $statusPengajuanBM;
        }else{
            $tempStatusBM = '';
        }

        // 
        $statusPengajuanAM = DB::table('trx-time-deposit')
        ->select('*')
        ->join('time-deposit', 'trx-time-deposit.id_td', '=', 'time-deposit.id')
        ->where('time-deposit.id_memmo',$id_memmo)
        ->where('role','Area Manager')
        ->pluck('aksi');
        // dd($statusPengajuanAM);
        if($statusPengajuanAM!=$string){
            $tempStatusAM = $statusPengajuanAM;
        }else{
            $tempStatusAM = '';
        }

        $statusPengajuanRH= DB::table('trx-time-deposit')
        ->select('*')
        ->join('time-deposit', 'trx-time-deposit.id_td', '=', 'time-deposit.id')
        ->where('time-deposit.id_memmo',$id_memmo)
        ->where('role','Regional Head')
        ->pluck('aksi');
        // dd($statusPengajuanAM);
        if($statusPengajuanRH!=$string){
            $tempStatusRH = $statusPengajuanRH;
        }else{
            $tempStatusRH = '';
        }


            if($cekIdTdDiUser==$string){
                $td_user = new TD_USER();
                $td_user->id_td = $id;
                $td_user->bm = $userBM[0]->username;
                $td_user->am = $userAM[0]->username;
                $td_user->rh = $userRH[0]->username;
                $td_user->dr = 'setiawati.samahita@idn.ccb.com';
                $td_user->region = $regional;
                $td_user->jumlah = $jumlah;
                $td_user->save();

                $td = TD::find($id);
                $td->approver = $td_user->jumlah;
                $td->save();

                return view('timeline-col',compact('data',$data,'allData',$allData,
                'maksApprover',$maksApprover,'tempStatusBM',$tempStatusBM,'tempStatusBM',$tempStatusBM,
                'tempStatusBM',$tempStatusBM,'tempStatusAM',$tempStatusAM,'tempStatusRH',$tempStatusRH));
            }else{
                
                return view('timeline-col',compact('data',$data,'allData',$allData,
                'maksApprover',$maksApprover,'tempStatusBM',$tempStatusBM,'tempStatusAM',$tempStatusAM,
                'tempStatusBM',$tempStatusBM,'tempStatusAM',$tempStatusAM,'tempStatusRH',$tempStatusRH));
            }
        
        
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
        $data = TD::where('id_memmo', $id)->get();
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
        return view('summaryCol',compact('data', $data))->with('apr',$dataApprover);
        //echo $id;
       
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
