@extends('master-dp')
@section('page-title','Time Deposit Special Rate')
@section('aktif-mtimedeplist','active')
@section('content')
    <!-- @if(Session::has('username'))
        <div class="alert alert-info"> ada token {{session('token')}};
            <button type="button" aria-hidden="true" class="close">×</button>
            <span><b> Info - </b><em> {!! session('flash_message') !!}</em></span>
        </div>
    @else
    <div class="alert alert-info"> Tidak ada login {{session('username')}};
            <button type="button" aria-hidden="true" class="close">×</button>
            <span><b> Info - </b><em> {!! session('flash_message') !!}</em></span>
        </div>
    @endif -->
    <div class="col-md-12">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Time Deposit Special Rate</h4>
                                    <p class="category">Data Pengajuan Special Rate login : {{session('username')}}</p>
                                </div></br>
                                <div align="right">
                                    <a href="{{route('time-deposit.create')}}">
                                        <i class="material-icons">assignment</i>create new data</a>
                                </div>
                                <div class="card-content table-responsive">
                            <!-- <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Full Name</th>
                                    <th>Amount</th>
                                    <th>Expired Date</th>
                                    <th>Period</th>
                                    <th>Type Of TD</th>
                                    <th>Date Rollover</th>
                                    <th>Expired Date</th>
                                    <th>Status</th>
                                    <th>action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $no = 1; @endphp
                                @foreach($data as $datas)
                                <?php 
                                        //RM
                                        // if(session('job')=='S0309'){
                                        //     $login = session('username');
                                        //     if($datas->created_by == $login){
                                                ?>
                                                <tr>
                                                    <td>{{$no++}}</td>
                                                        <td>{{$datas->full_name}}</br>{{$datas->created_by}}</td>
                                                        <td>{{number_format($datas->amount,2)}} ({{$datas->currency}})</td>
                                                        <td>{{$datas->expired_date}}</td>
                                                        <td>{{$datas->period}} Bulan</td>
                                                        <td>
                                                            @if($datas->type_of_td == 1)
                                                                {{$datas->type_of_td = 'B'}}
                                                            @else
                                                                {{$datas->type_of_td = 'U'}}
                                                            @endif
                                                        </td>
                                                        <td>{{$datas->date_rollover}}</td>
                                                        <td>{{$datas->expired_date}}</td>
                                                        <td>
                                                            @if($datas->status == 1)
                                                                {{$datas->status = 'F'}}
                                                            @else
                                                                {{$datas->status = 'P'}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{action('TDController@downloadSummary',$datas->id)}}" class="material-icons"  rel="tooltip" title="Generate PDF">assignment_returned</a>
                                                            <a href="{{action('TDController@timeline',$datas->id)}}" class="material-icons" rel="tooltip" title="Timeline">swap_vertical_circle</a>  
                                                        
                                                            <?php
                                                            //  if($datas->action == 1){ ?>
                                                                        <a href="javascript: void(0)" class="material-icons" rel="tooltip" title="Can Not Edit">mode_edit</a>
                                                            <?php    
                                                            // }elseif($datas->action== 0){ ?>
                                                                    <a href="{{route("td.edit",$datas->id)}}" class="material-icons" rel="tooltip" title="Edit Data">mode_edit</a>
                                                            <?php        
                                                            // }
                                                            ?>
                                                        </td>
                                                    </tr> 
                                                    <?php
                                            // }
                                        // }else if(session('job')=='S0465'){ 
                                                // dd($tdUser);
                                                // if($tdUser[0]->am == session('username')){
                                                    //  echo "<script type='text/javascript'>alert('ada');</script>";?>
                                                     <tr>
                                                    <td>{{$no++}}</td>
                                                        <td>{{$datas->full_name}}</br>{{$datas->created_by}}</td>
                                                        <td>{{number_format($datas->amount,2)}} ({{$datas->currency}})</td>
                                                        <td>{{$datas->expired_date}}</td>
                                                        <td>{{$datas->period}} Bulan</td>
                                                        <td>
                                                            @if($datas->type_of_td == 1)
                                                                {{$datas->type_of_td = 'B'}}
                                                            @else
                                                                {{$datas->type_of_td = 'U'}}
                                                            @endif
                                                        </td>
                                                        <td>{{$datas->date_rollover}}</td>
                                                        <td>{{$datas->expired_date}}</td>
                                                        <td>
                                                            @if($datas->status == 1)
                                                                {{$datas->status = 'F'}}
                                                            @else
                                                                {{$datas->status = 'P'}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{action('TDController@downloadSummary',$datas->id)}}" class="material-icons"  rel="tooltip" title="Generate PDF">assignment_returned</a>
                                                            <a href="{{action('TDController@timeline',$datas->id)}}" class="material-icons" rel="tooltip" title="Timeline">swap_vertical_circle</a>  
                                                        
                                                            <?php 
                                                            // if($datas->action == 1){ ?>
                                                                        <a href="javascript: void(0)" class="material-icons" rel="tooltip" title="Can Not Edit">mode_edit</a>
                                                            <?php       
                                                        //  }elseif($datas->action== 0){ ?>
                                                                    <a href="{{route("td.edit",$datas->id)}}" class="material-icons" rel="tooltip" title="Edit Data">mode_edit</a>
                                                            <?php        
                                                            // }
                                                            ?>
                                                        </td>
                                                    </tr> 
                                                    <?php
                                                // }else{
                                                    // echo "<script type='text/javascript'>alert('ga ada');</script>";
                                            //   }
                                        // }
                                    ?>
                                
                                    
                                @endforeach
                                </tbody>
                            </table> -->
                            <!-- //coba -->
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Full Name </th>
                                        <th>Amount</th>
                                        <th>Special Rate (%)</th>
                                        <th>Period</th>
                                        <!-- <th>branch</th> -->
                                        <th>Created By</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <!-- <th>bm</th>
                                        <th>am</th>
                                        <th>rh</th>
                                        <th>dr</th>
                                        <th>jumlah</th> -->
                                    </tr>
                                </thead>
                                        <tbody>
                                        <?php $no = 1; ?>
                                    @foreach($lengkap as $datalengkap)
                                    
                                    <?php
                                    // rm / created_by
                                        if(session('job')=='S0309'){
                                            $login = session('username');
                                            if(session('username')==$datalengkap->created_by){ ?>
                                                <tr>
                                                    <td>{{$no++}}</td>
                                                    <td>{{$datalengkap->full_name}}</td>
                                                    <td>{{number_format($datalengkap->amount,0)}} {{$datalengkap->currency}}</td>
                                                    <td>{{$datalengkap->special_rate}} %</td>
                                                    <td>{{$datalengkap->period}} bln</td>
                                                    <!-- <td>{{$datalengkap->id_branch}}</td> -->
                                                    <td>{{$datalengkap->created_by}}</td>
                                                    <!-- <td>{{$datalengkap->bm}}</td>
                                                    <td>{{$datalengkap->am}}</td>
                                                    <td>{{$datalengkap->rh}}</td>
                                                    <td>{{$datalengkap->dr}}</td>
                                                    <td>{{$datalengkap->jumlah}}</td> -->

                                                    <td>{{$datalengkap->status}}</td>
                                                    <td>
                                                             <?php if($datalengkap->status == 'FINISH'){ ?>
                                                                <a href="{{action('TDController@downloadSummary',$datalengkap->id)}}" class="material-icons"  rel="tooltip" title="Generate PDF">assignment_returned</a>
                                                            <?php
                                                             }else{?>
                                                                 <a href="javascript: void(0)" class="material-icons"  rel="tooltip" title="Can't Generate PDF">assignment_returned</a>
                                                             <?php
                                                             }
                                                             ?>
                                                                <a href="{{action('TDController@timeline',$datalengkap->id)}}" class="material-icons" rel="tooltip" title="Timeline">swap_vertical_circle</a>  

                                                        
                                                            <?php if($datalengkap->action == 1 || $datalengkap->status == 'Rejected'){ ?>
                                                                        <a href="javascript: void(0)" class="material-icons" rel="tooltip" title="Can Not Edit">mode_edit</a>
                                                            <?php        }elseif($datalengkap->action== 0){ ?>
                                                                    <a href="{{route("td.edit",$datalengkap->id)}}" class="material-icons" rel="tooltip" title="Edit Data">mode_edit</a>
                                                            <?php        
                                                            }
                                                            ?>
                                                    </td>
                                                </tr> 
                                   <?php    }
                                        }
                                        // area head / am
                                        else if(session('username')=='rahman.fianto@idn.ccb.com' || session('username')=='sherly.marthalena@idn.ccb.com'){
                                            $login = session('username');
                                            if($login==$datalengkap->am){ ?>
                                                <tr>
                                                    <td>{{$no++}}</td>
                                                    <td>{{$datalengkap->full_name}}</td>
                                                    <td>{{number_format($datalengkap->amount,0)}} {{$datalengkap->currency}}</td>
                                                    <td>{{$datalengkap->special_rate}} %</td>
                                                    <td>{{$datalengkap->period}} bln</td>
                                                    <!-- <td>{{$datalengkap->id_branch}}</td> -->
                                                    <td>{{$datalengkap->created_by}}</td>
                                                    <!-- <td>{{$datalengkap->bm}}</td>
                                                    <td>{{$datalengkap->am}}</td>
                                                    <td>{{$datalengkap->rh}}</td>
                                                    <td>{{$datalengkap->dr}}</td>
                                                    <td>{{$datalengkap->jumlah}}</td> -->
                                                    <td>{{$datalengkap->status}}</td>
                                                    <td>
                                                        <?php if($datalengkap->status == 'FINISH'){ ?>
                                                                <a href="{{action('TDController@downloadSummary',$datalengkap->id)}}" class="material-icons"  rel="tooltip" title="Generate PDF">assignment_returned</a>
                                                            <?php
                                                             }else{?>
                                                                 <a href="javascript: void(0)" class="material-icons"  rel="tooltip" title="Can't Generate PDF">assignment_returned</a>
                                                             <?php
                                                             }
                                                        ?>
                                                            <!-- <a href="{{action('TDController@downloadSummary',$datalengkap->id)}}" class="material-icons"  rel="tooltip" title="Generate PDFxxx">assignment_returned</a> -->
                                                            <a href="{{action('TDController@timeline',$datalengkap->id)}}" class="material-icons" rel="tooltip" title="Timeline">swap_vertical_circle</a>  
                                                        
                                                            <?php if($datalengkap->action == 1 || $datalengkap->status == 'Rejected'){ ?>
                                                                        <a href="javascript: void(0)" class="material-icons" rel="tooltip" title="Can Not Edit">mode_edit</a>
                                                            <?php        }elseif($datalengkap->action== 0){ ?>
                                                                    <a href="{{route("td.edit",$datalengkap->id)}}" class="material-icons" rel="tooltip" title="Edit Data">mode_edit</a>
                                                            <?php        
                                                            }
                                                            ?>
                                                    </td>
                                                </tr> 
                                   <?php    
                                            }
                                        }
                                        // bm / branch manager
                                        else if(session('job') == 'S0362'){
                                            $login = session('username');
                                            if($login == $datalengkap->bm ){ ?>
                                                <tr>
                                                    <td>{{$no++}}</td>
                                                    <td>{{$datalengkap->full_name}}</td>
                                                    <td>{{number_format($datalengkap->amount,0)}} {{$datalengkap->currency}}</td>
                                                    <td>{{$datalengkap->special_rate}} %</td>
                                                    <td>{{$datalengkap->period}} bln</td>
                                                    <!-- <td>{{$datalengkap->id_branch}}</td> -->
                                                    <td>{{$datalengkap->created_by}}</td>
                                                    <!-- <td>{{$datalengkap->bm}}</td>
                                                    <td>{{$datalengkap->am}}</td>
                                                    <td>{{$datalengkap->rh}}</td>
                                                    <td>{{$datalengkap->dr}}</td>
                                                    <td>{{$datalengkap->jumlah}}</td> -->
                                                    <td>{{$datalengkap->status}}</td>
                                                    <td>
                                                        <?php if($datalengkap->status == 'FINISH'){ ?>
                                                                <a href="{{action('TDController@downloadSummary',$datalengkap->id)}}" class="material-icons"  rel="tooltip" title="Generate PDF">assignment_returned</a>
                                                            <?php
                                                             }else{?>
                                                                 <a href="javascript: void(0)" class="material-icons"  rel="tooltip" title="Can't Generate PDF">assignment_returned</a>
                                                             <?php
                                                             }
                                                        ?>
                                                            <a href="{{action('TDController@timeline',$datalengkap->id)}}" class="material-icons" rel="tooltip" title="Timeline">swap_vertical_circle</a>  
                                                    </td>
                                            </tr> 
                                <?php   }
                                        }
                                //    rh / regional head
                                        else if(session('job') == 'S0301'){
                                            $login = session('username');
                                            if($login==$datalengkap->rh && $datalengkap->jumlah >= 3){ ?>
                                                     <tr>
                                                        <td>{{$no++}}</td>
                                                        <td>{{$datalengkap->full_name}}</td>
                                                        <td>{{number_format($datalengkap->amount,0)}} {{$datalengkap->currency}}</td>
                                                        <td>{{$datalengkap->special_rate}} %</td>
                                                        <td>{{$datalengkap->period}} bln</td>
                                                        <!-- <td>{{$datalengkap->id_branch}}</td> -->
                                                        <td>{{$datalengkap->created_by}}</td>
                                                        <!-- <td>{{$datalengkap->bm}}</td>
                                                        <td>{{$datalengkap->am}}</td>
                                                        <td>{{$datalengkap->rh}}</td>
                                                        <td>{{$datalengkap->dr}}</td>
                                                        <td>{{$datalengkap->jumlah}}</td> -->
                                                        <td>{{$datalengkap->status}}</td>
                                                        <td>
                                                        <?php if($datalengkap->status == 'FINISH'){ ?>
                                                            <a href="{{action('TDController@downloadSummary',$datalengkap->id)}}" class="material-icons"  rel="tooltip" title="Generate PDF">assignment_returned</a>
                                                        <?php
                                                            }else{?>
                                                            <a href="javascript: void(0)" class="material-icons"  rel="tooltip" title="Can't Generate PDF">assignment_returned</a>
                                                        <?php
                                                            }
                                                        ?>
                                                                <a href="{{action('TDController@timeline',$datalengkap->id)}}" class="material-icons" rel="tooltip" title="Timeline">swap_vertical_circle</a>  
                                                         
                                                        </td>
                                                </tr>   
                                 <?php  }
                                    }else if(session('job')=='S9' || session('job') == 'S0148'){ 
                                        $login = session('username');
                                        if($login=='setiawati.samahita@idn.ccb.com' && $datalengkap->jumlah >= 4){ ?>
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$datalengkap->full_name}}</td>
                                            <td>{{number_format($datalengkap->amount,0)}} {{$datalengkap->currency}}</td>
                                            <td>{{$datalengkap->special_rate}} %</td>
                                            <td>{{$datalengkap->period}}</td>
                                            <!-- <td>{{$datalengkap->id_branch}}</td> -->
                                            <td>{{$datalengkap->created_by}}</td>
                                            <!-- <td>{{$datalengkap->bm}}</td>
                                            <td>{{$datalengkap->am}}</td>
                                            <td>{{$datalengkap->rh}}</td>
                                            <td>{{$datalengkap->dr}}</td>
                                            <td>{{$datalengkap->jumlah}}</td> -->
                                            <td>{{$datalengkap->status}}</td>
                                            <td>
                                                <?php if($datalengkap->status == 'FINISH'){ ?>
                                                        <a href="{{action('TDController@downloadSummary',$datalengkap->id)}}" class="material-icons"  rel="tooltip" title="Generate PDF">assignment_returned</a>
                                                <?php
                                                    }else{?>
                                                        <a href="javascript: void(0)" class="material-icons"  rel="tooltip" title="Can't Generate PDF">assignment_returned</a>
                                                <?php
                                                    }
                                                ?>
                                                
                                                <a href="{{action('TDController@timeline',$datalengkap->id)}}" class="material-icons" rel="tooltip" title="Timeline">swap_vertical_circle</a>  
                                            </td>
                                    </tr> 
                            <?php
                                    }
                                }
                                    ?>
                                    
                                    @endforeach
                                    </tbody>
                            </table>
                            </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection