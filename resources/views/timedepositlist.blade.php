@extends('master')
@section('page-title','Time Deposit List')
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
                            <div class="card card-plain">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Table Time Deposit</h4>
                                    <p class="category">Time Deposit Special Rate</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <th>No</th>
                                            <th>Bank</th>
                                            <th>Tipe </th>
                                            <th>Amount</th>
                                            <th>Rate</th>
                                            <th>Period</th>
                                            <th>TD</th>
                                        </thead>
                                            @php $no = 1; @endphp
                                            @foreach($data as $datas)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$datas->bank}}</td>
                                                <td>{{$datas->tipe}}</td>
                                                <td>{{$datas->amount}}</td>
                                                <td>{{$datas->rate}}</td>
                                                <td>{{$datas->period}}</td>
                                                <td>{{$datas->td}}</td>
                                            </tr>
                                            @endforeach
                                        <tbody>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
@endsection