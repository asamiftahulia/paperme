@extends('master-dp')
@section('page-title','Master Branch')
@section('aktif-m-sr','active')
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
                            <h3 align="center">
                                <b>Master Special Rate</b>
                            </h3>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                        <th>No</th>
                                            {{--<th>ID</th>--}}
                                            <th>Term</th>
                                            <th>Counter Rate</th>
                                            <th>Area Manager</th>
                                            <th>Regional Head</th>
                                            <th>Director</th>
                                        </tr>    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                            @foreach($data as $datas)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                {{--<td>{{$datas->id}}</td>--}}
                                                <td>{{$datas->term}}</td>
                                                <td>{{$datas->counter_rate}}</td>
                                                <td>{{$datas->area_manager}}</td>
                                                <td>{{$datas->regional_head}}</td>
                                                <td>{{$datas->director}}</td>
                                            </tr>
                                              @endforeach
                                    </tbody>
                                </table>
                                <p> Note : logika implementasi terkait pengajuan special rate <= ”lebih kecil sama dengan”</br>
                                    untuk jenjang Direktur Bisnis > "lebih besar dari" 
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->       
                    </div>
@endsection