@extends('master-dp')
@section('page-title','Time Deposit Special Rate')
@section('aktif-mtimedeplist','active')
@section('content')
    <div class="col-md-12">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Time Deposit Special Rate</h4>
                                    <p class="category">Data Pengajuan Special Rate login : {{session('username')}}</p>
                                </div></br>
                                <?php
                                    if(session('job') == 'S0309'){
                                ?>
                               
                                <?php
                                    }
                                ?>
                                <div class="card-content table-responsive">
                          
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
                                        <!-- <th>Created By</th> -->
                                        <th>Status</th>
                                        <th style="width:80px">Action</th>
                                        <!-- <th>bm</th>
                                        <th>am</th>
                                        <th>rh</th>
                                        <th>dr</th>
                                        <th>jumlah</th> -->
                                    </tr>
                                </thead>
                                        <tbody>
                                        <?php $no = 1; 
                                    // rm / created_by
                                        if(session('job')=='S0309'){
                                            $login = session('username');
                                            foreach($lengkap as $datalengkap){
                                            if(session('username')==$datalengkap->created_by){ ?>
                                                <tr style="height:3px;">
                                                    <td>{{$no++}}</td>
                                                    <td>{{$datalengkap->full_name}}</td>
                                                    <td>{{number_format($datalengkap->amount,0)}} {{$datalengkap->currency}}</td>
                                                    <td>{{$datalengkap->special_rate}} %</td>
                                                    <td>{{$datalengkap->period}} bln</td>
                                                    <!-- <td>{{$datalengkap->id_branch}}</td> -->
                                                    <!-- <td>{{$datalengkap->created_by}}</td> -->
                                                    <!-- <td>{{$datalengkap->bm}}</td>
                                                    <td>{{$datalengkap->am}}</td>
                                                    <td>{{$datalengkap->rh}}</td>
                                                    <td>{{$datalengkap->dr}}</td>
                                                    <td>{{$datalengkap->jumlah}}</td> -->
                                                    <td>{{$datalengkap->status}}</td>
                                                    <td>
                                                             @if($datalengkap->status == 'FINISH')
                                                                <a href="{{action('TDController@downloadSummary',$datalengkap->id_td)}}" class="material-icons"  rel="tooltip" title="Generate PDF">assignment_returned</a>
                                                             @elseif($datalengkap->status == 'Rejected')
                                                                <a href="{{action('TDController@renew',$datalengkap->id)}}" class="material-icons"  rel="tooltip" title="Ajukan Ulang">autorenew</a>
                                                             @else
                                                                 <a href="javascript: void(0)" class="material-icons"  rel="tooltip" title="Can't Generate PDF">assignment_returned</a>
                                                             @endif
                                                                <a href="{{action('TDController@timeline',$datalengkap->id_td)}}" class="material-icons" rel="tooltip" title="Timeline">swap_vertical_circle</a>  
                                                            @if($datalengkap->action == 1 || $datalengkap->status == 'Rejected')
                                                                        <a href="javascript: void(0)" class="material-icons" rel="tooltip" title="Can Not Edit">mode_edit</a>
                                                            @elseif($datalengkap->action== 0)
                                                                    <a href="{{route("td.edit",$datalengkap->id)}}" class="material-icons" rel="tooltip" title="Edit Data">mode_edit</a>
                                                            @endif

                                                    </td>
                                                </tr> 
                                   <?php    }
                                        }
                                        }
                                        
                                        // area head / am
                                        else if(session('username')=='rahman.fianto@idn.ccb.com' || session('username')=='sherly.marthalena@idn.ccb.com'){
                                            $login = session('username'); 
                                        ?>
                                            @foreach($lengkapForBM as $dataBM)
                                        <?php
                                            if($login==$dataBM->am){ ?>
                                                <tr>
                                                    <td>{{$no++}}</td>
                                                    <td>{{$dataBM->full_name}}</td>
                                                    <td>{{number_format($dataBM->amount,0)}} {{$dataBM->currency}}</td>
                                                    <td>{{$dataBM->special_rate}} %</td>
                                                    <td>{{$dataBM->period}} bln</td>
                                                    <td>{{$dataBM->status}}</td>
                                                    <td>
                                                        <?php if($dataBM->status == 'FINISH'){ ?>
                                                                <a href="{{action('TDController@downloadSummary',$dataBM->id_td)}}" class="material-icons"  rel="tooltip" title="Generate PDF">assignment_returned</a>
                                                            <?php
                                                             }else{?>
                                                                 <a href="javascript: void(0)" class="material-icons"  rel="tooltip" title="Can't Generate PDF">assignment_returned</a>
                                                             <?php
                                                             }
                                                        ?>
                                                            
                                                            <a href="{{action('TDController@timeline',$dataBM->id_td)}}" class="material-icons" rel="tooltip" title="Timeline">swap_vertical_circle</a>                                                          
                                                          
                                                    </td>
                                                </tr> 
                                                <?php
                                            }
                                            ?>
                                            @endforeach
                                   <?php    
                                            
                                        }
                                        // bm / branch manager
                                        else if(session('job') == 'S0362'){
                                            $login = session('username'); ?>
                                            @foreach($lengkapForBM as $dataBM)
                                        <?php   if($login == $dataBM->bm){ ?>
                                                <tr>
                                                    <td>{{$no++}}</td>
                                                    <td>{{$dataBM->full_name}}</td>
                                                    <td>{{number_format($dataBM->amount,0)}} {{$dataBM->currency}}</td>
                                                    <td>{{$dataBM->special_rate}} %</td>
                                                    <td>{{$dataBM->period}} bln</td>
                                                    <td>{{$dataBM->status}}</td>
                                                    <td>
                                                        <?php if($dataBM->status == 'FINISH'){ ?>
                                                                <a href="{{action('TDController@downloadSummary',$dataBM->id_td)}}" class="material-icons"  rel="tooltip" title="Generate PDF">assignment_returned</a>
                                                            <?php
                                                             }else{?>
                                                                 <a href="javascript: void(0)" class="material-icons"  rel="tooltip" title="Can't Generate PDF">assignment_returned</a>
                                                             <?php
                                                             }
                                                        ?>
                                                            <a href="{{action('TDController@timeline',$dataBM->id_td)}}" class="material-icons" rel="tooltip" title="Timeline">swap_vertical_circle</a>  
                                                    </td>
                                            </tr>
                                    <?php
                                        }
                                        ?> 
                                        @endforeach
                                <?php   
                                        }
                                //    rh / regional head
                                        else if(session('job') == 'S0301'){
                                            $login = session('username'); ?>
                                            @foreach($lengkapForBM as $dataBM)
                                        
                                        <?php    if($login==$dataBM->rh && $dataBM->approver >= 3){ ?>
                                                     <tr>
                                                        <td>{{$no++}}</td>
                                                        <td>{{$dataBM->full_name}}</td>
                                                        <td>{{number_format($dataBM->amount,0)}} {{$dataBM->currency}}</td>
                                                        <td>{{$dataBM->special_rate}} %</td>
                                                        <td>{{$dataBM->period}} bln</td>
                                                        <td>{{$dataBM->status}}</td>
                                                        <td>
                                                        <?php if($dataBM->status == 'FINISH'){ ?>
                                                            <a href="{{action('TDController@downloadSummary',$dataBM->id_td)}}" class="material-icons"  rel="tooltip" title="Generate PDF">assignment_returned</a>
                                                        <?php
                                                            }else{?>
                                                            <a href="javascript: void(0)" class="material-icons"  rel="tooltip" title="Can't Generate PDF">assignment_returned</a>
                                                        <?php
                                                            }
                                                        ?>
                                                                <a href="{{action('TDController@timeline',$dataBM->id_td)}}" class="material-icons" rel="tooltip" title="Timeline">swap_vertical_circle</a>  
                                                         
                                                        </td>
                                                </tr>   
                                                <?php 
                                                    }
                                                ?>
                                        @endforeach
                                 <?php  
                                    }else if(session('job')=='S9' || session('job') == 'S0148' || session('username') == 'setiawati.samahita@idn.ccb.com'){ 
                                        $login = session('username');  
                                 ?>
                                    @foreach($lengkap as $dataBM)
                                      <?php
                                         if($login=='setiawati.samahita@idn.ccb.com' && $dataBM->approver >= 4){ ?>
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$dataBM->full_name}}</td>
                                            <td>{{number_format($dataBM->amount,0)}} {{$dataBM->currency}}</td>
                                            <td>{{$dataBM->special_rate}} %</td>
                                            <td>{{$dataBM->period}}</td>
                                            <td>{{$dataBM->status}}</td>
                                            <td>
                                                <?php if($dataBM->status == 'FINISH'){ ?>
                                                        <a href="{{action('TDController@downloadSummary',$dataBM->id_td)}}" class="material-icons"  rel="tooltip" title="Generate PDF">assignment_returned</a>
                                                <?php
                                                    }else{?>
                                                        <a href="javascript: void(0)" class="material-icons"  rel="tooltip" title="Can't Generate PDF">assignment_returned</a>
                                                <?php
                                                    }
                                                ?>
                                                
                                                <a href="{{action('TDController@timeline',$dataBM->id_td)}}" class="material-icons" rel="tooltip" title="Timeline">swap_vertical_circle</a>  
                                            </td>
                                    </tr> 
                                    <?php
                                         }
                                    ?>
                                    @endforeach
                            <?php    
                            }
                                    ?>
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