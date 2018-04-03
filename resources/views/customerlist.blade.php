@extends('master')
@section('page-title','Customer List')
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
                                    <h4 class="title">Table on Plain Background</h4>
                                    <p class="category">Here is a subtitle for this table</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <button name="btn-pdf">Export To PDF</button>
                                    <table class="table table-hover">
                                        <thead>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach($data as $datas)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$datas->fullname}}</td>
                                                <td>{{$datas->email}}</td>
                                                <td>{{$datas->phone_number}}</td>
                                                <td>{{$datas->address}}</td>
                                                <td>
                                                     <form action="{{route('customer.destroy',$datas->id)}}" method="post">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}
                                                            <a href="{{route('customer.edit',$datas->id)}}" class="material-icons">mode_edit</a>
                                                            <a href="{{route('customer.edit',$datas->id)}}" class="material-icons">delete</a>
                                                           <!--  <button class="material-icons" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">delete</button> -->
                                                        </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
@endsection