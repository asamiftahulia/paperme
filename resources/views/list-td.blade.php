@extends('master-dp')
@section('page-title','Time Deposit Special Rate')
@section('aktif-mtimedep','active')
@section('content')
    @if(Session::has('flash_message'))
        <div class="alert alert-info">
            <button type="button" aria-hidden="true" class="close">×</button>
            <span><b> Info - </b><em> {!! session('flash_message') !!}</em></span>
        </div>
        @php
            $flash = Session::get('flash_message');
        @endphp
    @endif
    <div class="col-md-12">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Time Deposit Special Rate</h4>
                                    <p class="category">Data Pengajuan Special Rate</p>
                                </div>
                                <div class="card-content table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Full Name</th>
                                    <th>Amount </th>
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
                                    <tr>
                                       <td>{{$no++}}</td>
                                        <td>{{$datas->full_name}}</td>
                                        <td>{{$datas->amount}}</td>
                                        <td>{{$datas->expired_date}}</td>
                                        <td>{{$datas->period}} Bulan</td>
                                        <td>{{$datas->type_of_td}}</td>
                                        <td>{{$datas->date_rollover}}</td>
                                        <td>{{$datas->expired_date}}</td>
                                         <td>
                                            @if($datas->status == 1)
                                                {{$datas->status = 'FINISHED'}}
                                            @else
                                                 {{$datas->status = 'ON_PROGRESS'}}
                                            @endif
                                        </td>
                                        <td>
                                        
                                            <a href="{{action('TDController@downloadSummary',$datas->id)}}" class="material-icons"  rel="tooltip" title="Generate PDF">assignment_returned</a>
                                            <a href="{{action('TDController@timeline',$datas->id)}}" class="material-icons" rel="tooltip" title="Timeline">swap_vertical_circle</a>  
                                            <a href="{{route('td.edit',$datas->id)}}" class="material-icons" rel="tooltip" title="Edit Data">mode_edit</a>  
                                        </td>
                                    </tr>
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