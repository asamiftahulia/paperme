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
                    <div class="header">
                        <h5>
                            Time Deposit Special Rate
                        </h5>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Full Name</th>
                                    <th>Amount </th>
                                    
                                    <th>Notes</th>
                                    <th>Expired Date</th>
                                    <th>Period</th>
                                    <th>Type Of TD</th>
                                    <th>Bank</th>
                                    <th>Date Rollover</th>
                                    <th>Status</th>
                                    <th>action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Full Name</th>
                                    <th>Amount </th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                    <th>Expired Date</th>
                                    <th>Period</th>
                                    <th>Type Of TD</th>
                                    <th>Bank</th>
                                    <th>Date Rollover</th>
                                    <th>action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @php $no = 1; @endphp
                                @foreach($data as $datas)
                                    <tr>
                                       <td>{{$no++}}</td>
                                        <td>{{$datas->full_name}}</td>
                                        <td>{{$datas->amount}}</td>
                                       
                                        <td>{{$datas->notes}}</td>
                                        <td>{{$datas->expired_date}}</td>
                                        <td>{{$datas->period}}</td>
                                        <td>{{$datas->type_of_td}}</td>
                                        <td>{{$datas->bank}}</td>
                                        <td>{{$datas->date_rollover}}</td>
                                         <td>
                                            @if($datas->status == 1)
                                                {{$datas->status = 'NEW'}}
                                            @else
                                                 {{$datas->status = 'EXISTING'}}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{action('TDController@downloadSummary',1)}}" class="material-icons">assignment_returned</a>
                                            <a href="{{action('TDController@timeline',1)}}" class="material-icons">swap_vertical_circle</a>  
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
        <!-- #END# Exportable Table -->
    </div>
@endsection