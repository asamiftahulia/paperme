@extends('master-dp')
@section('page-title','Time Deposit Special Rate')
@section('aktif-mtimedeplistFinish','active')
@section('content')
    <div class="col-md-12">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Time Deposit Special Rate</h4>
                                    <p class="category">Data Pengajuan Special Rate login : {{session('username')}}</p>
                                </div></br>
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
                                        <th>Status</th>
                                        <th style="width:80px">Action</th>
                                    </tr>
                                </thead>
                                        <tbody>
                                        <?php $no = 1; 
                                    // rm / created_by
                                            foreach($dataFinish as $datalengkap){ ?>
                                                <tr style="height:3px;">
                                                    <td>{{$no++}}</td>
                                                    <td>{{$datalengkap->full_name}}</td>
                                                    <td>{{number_format($datalengkap->amount,0)}} {{$datalengkap->currency}}</td>
                                                    <td>{{$datalengkap->special_rate}} %</td>
                                                    <td>{{$datalengkap->period}} bln</td>
                                                    <td>{{$datalengkap->status}}</td>
                                                    <td>
                                                             @if($datalengkap->status == 'FINISH')
                                                                <a href="{{action('TDController@downloadSummary',$datalengkap->id)}}" class="material-icons"  rel="tooltip" title="Generate PDF">assignment_returned</a>
                                                             @elseif($datalengkap->status == 'Rejected')
                                                                <a href="{{action('TDController@renew',$datalengkap->id)}}" class="material-icons"  rel="tooltip" title="Ajukan Ulang">autorenew</a>
                                                             @else
                                                                 <a href="javascript: void(0)" class="material-icons"  rel="tooltip" title="Can't Generate PDF">assignment_returned</a>
                                                             @endif

                                                             @if($datalengkap->col =='col')
                                                                <a href="{{action('TDCollectiveController@timelineCollective',$datalengkap->id_memmo)}}" class="material-icons" rel="tooltip" title="Timeline Collective">swap_vertical_circle</a>  
                                                             @else
                                                                <a href="{{action('TDController@timeline',$datalengkap->id)}}" class="material-icons" rel="tooltip" title="Timeline">swap_vertical_circle</a>  
                                                             @endif  
                                                    </td>
                                                </tr> 
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