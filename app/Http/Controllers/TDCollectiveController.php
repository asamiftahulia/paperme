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
                    if($datas['period'] == 1 || $datas['period'] == 3){
                        if($datas['special_rate'] == '5.25' || $datas['special_rate'] <= '6.00'){
                            $dataApprover = array('approver'=>'AM');
                            $jumlah = 2;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] == '5.25' || $datas['special_rate'] <= '6.25'){
                            $dataApprover = array('approver'=>'AM','Regional Head');
                            $jumlah = 3;
                            $period = "1 & 3";
                        }else if($datas['special_rate'] == '5.25' || $datas['special_rate'] > '6.25'){
                            $dataApprover = array('approver'=>'AM','Regional Head','Director');
                            $jumlah = 4;
                            $period = "1 & 3";
                        }else{
                            echo 'Approver Not Found';
                        }
                    }else if($datas['period'] == 6 || $datas['period'] == 12){
                        if($datas['special_rate'] == '5.50' || $datas['special_rate'] <= '5.75'){
                            $dataApprover = array('approver'=>'AM');
                            $jumlah = 2;
                            $period = "6 & 12";
                        }else if($datas['special_rate'] == '5.50' || $datas['special_rate'] <= '6.00'){
                            $dataApprover = array('approver'=>'AM','Regional Head');
                            $jumlah = 3;
                            $period = "6 & 12";
                        }else if($datas['special_rate'] == '5.50' || $datas['special_rate'] > '6.00'){
                            $dataApprover = array('approver'=>'AM','Regional Head','Director');
                            $jumlah = 4;
                            $period = "6 & 12";
                        }else{
                            echo 'Approver Not Found';
                        }
                    }
                }elseif($datas['currency']=='USD'){
                     $period = "All Period";
                    if($datas['special_rate'] == '0.50' || $datas['special_rate'] <= '1.00'){
                        $dataApprover = array('approver'=>'AM');
                        $jumlah = 2;
                       
                    }else if($datas['special_rate'] == '1.00' || $datas['special_rate'] <= '1.25'){
                        $dataApprover = array('approver'=>'AM','Regional Head');
                        $jumlah = 3;
                    }else if($datas['special_rate'] > '1.25'){
                        $dataApprover = array('approver'=>'AM','Regional Head','Director');
                        $jumlah = 4;
                    }else{
                        echo 'Approver Not Found';
                    }
                }elseif($datas['currency']=='SGD'){
                    $period = "All Period";
                    if($datas['special_rate'] == '0.50' || $datas['special_rate'] <= '0.75'){
                        $dataApprover = array('approver'=>'AM');
                        $jumlah = 2;
                    }else if($datas['special_rate'] == '0.75' || $datas['special_rate'] <= '1.00'){
                        $dataApprover = array('approver'=>'AM','Regional Head');
                        $jumlah = 3;
                    }else if($datas['special_rate'] > '1.00'){
                        $dataApprover = array('approver'=>'AM','Regional Head','Director');
                        $jumlah = 4;
                    }else{
                        echo 'Approver Not Found';
                    }
                }elseif($datas['currency']=='CNY'){
                    $period = "All Period";
                    if($datas['special_rate'] == '0.50' || $datas['special_rate'] <= '1.25'){
                        $dataApprover = array('approver'=>'AM');
                        $jumlah = 2;
                    }else if($datas['special_rate'] == '1.25' || $datas['special_rate'] <= '1.50'){
                        $dataApprover = array('approver'=>'AM','Regional Head');
                        $jumlah = 3;
                    }else if($datas['special_rate'] > '1.50'){
                        $dataApprover = array('approver'=>'AM','Regional Head','Director');
                        $jumlah = 4;
                    }else{
                        echo 'Approver Not Found';
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
        // dd($allData);

        $statusPengajuanBM = DB::table('trx-time-deposit')
        ->select('*')
        ->join('time-deposit', 'trx-time-deposit.id_td', '=', 'time-deposit.id')
        ->where('time-deposit.id_memmo',$id_memmo)
        ->where('role','Branch Manager')
        ->pluck('aksi');
        
       
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

                
                return view('timeline-col',compact('data',$data,'allData',$allData,'maksApprover',$maksApprover,'tempStatusBM',$tempStatusBM,'tempStatusBM',$tempStatusBM));
            }else{
               
                return view('timeline-col',compact('data',$data,'allData',$allData,'maksApprover',$maksApprover,'tempStatusBM',$tempStatusBM,'tempStatusAM',$tempStatusAM));
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
            if($datas['currency'] == 'IDR'){
                if($datas['period'] == 1 || $datas['period'] == 3){
                    if($datas['special_rate'] == '5.25' || $datas['special_rate'] <= '6.00'){
                        // echo'AM';
                        $dataApprover = array('approver'=>'Area Manager');
                    }else if($datas['special_rate'] == '5.25' || $datas['special_rate'] <= '6.25'){
                        $dataApprover = array('approver'=>'Area Manager','Regional Head');
                    }else if($datas['special_rate'] == '5.25' || $datas['special_rate'] > '6.25'){
                        $dataApprover = array('approver'=>'Area Manager','Regional Head','Director');
                    }else{
                        echo 'Approver Not Found';
                    }
                }else if($datas['period'] == 6 || $datas['period'] == 12){
                    if($datas['special_rate'] == '5.50' || $datas['special_rate'] <= '5.75'){
                        $dataApprover = array('approver'=>'Area Manager');
                    }else if($datas['special_rate'] == '5.50' || $datas['special_rate'] <= '6.00'){
                        $dataApprover = array('approver'=>'Area Manager','Regional Head');
                    }else if($datas['special_rate'] == '5.50' || $datas['special_rate'] > '6.00'){
                        $dataApprover = array('approver'=>'Area Manager','Regional Head','Director');
                    }else{
                        echo 'Approver Not Found';
                    }
                }else if($datas['period'] == 12){
                    if($datas['special_rate'] == '5.50' || $datas['special_rate'] <= '5.75'){
                        $dataApprover = array('approver'=>'Area Manager');
                    }else if($datas['special_rate'] == '5.50' || $datas['special_rate'] <= '60.00'){
                        $dataApprover = array('approver'=>'Area Manager','Regional Head');
                    }else if($datas['special_rate'] == '5.50' || $datas['special_rate'] > '6.00'){
                        $dataApprover = array('approver'=>'Area Manager','Regional Head','Director');
                    }else{
                        echo 'Approver Not Found';
                    }
                }
            }elseif($datas['currency']=='USD'){
                $period = "All Period";
               if($datas['special_rate'] == '0.50' || $datas['special_rate'] <= '1.00'){
                   $dataApprover = array('approver'=>'Area Manager');
                   $apr = 2;
                  
               }else if($datas['special_rate'] == '1.00' || $datas['special_rate'] <= '1.25'){
                   $dataApprover = array('approver'=>'Area Manager','Regional Head');
                   $apr = 3;
               }else if($datas['special_rate'] > '1.25'){
                   $dataApprover = array('approver'=>'Area Manager','Regional Head','Director');
                   $apr = 4;
               }else{
                   echo 'Approver Not Found';
               }
           }elseif($datas['currency']=='SGD'){
               $period = "All Period";
               if($datas['special_rate'] == '0.50' || $datas['special_rate'] <= '0.75'){
                   $dataApprover = array('approver'=>'Area Manager');
                   $apr = 2;
               }else if($datas['special_rate'] == '0.75' || $datas['special_rate'] <= '1.00'){
                   $dataApprover = array('approver'=>'Area Manager','Regional Head');
                   $apr = 3;
               }else if($datas['special_rate'] > '1.00'){
                   $dataApprover = array('approver'=>'Area Manager','Regional Head','Director');
                   $apr = 4;
               }else{
                   echo 'Approver Not Found';
               }
           }elseif($datas['currency']=='CNY'){
               $period = "All Period";
               if($datas['special_rate'] == '0.50' || $datas['special_rate'] <= '1.25'){
                   $dataApprover = array('approver'=>'Area Manager');
                   $apr = 2;
               }else if($datas['special_rate'] == '1.25' || $datas['special_rate'] <= '1.50'){
                   $dataApprover = array('approver'=>'Area Manager','Regional Head');
                   $apr = 3;
               }else if($datas['special_rate'] > '1.50'){
                   $dataApprover = array('approver'=>'Area Manager','Regional Head','Director');
                   $apr = 4;
               }else{
                   echo 'Approver Not Found';
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
