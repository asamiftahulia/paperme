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
                                    <h4 class="title">Data Master Bank</h4>
                                    <p class="category">Data master bank</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Name Bank</th>
                                            <th>Created By</th>
                                            <th>Updated By</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach($data as $datas)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$datas->id}}</td>
                                                <td>{{$datas->name_bank}}</td>
                                                <td>{{$datas->created_by}}</td>
                                                <td>{{$datas->updated_by}}</td>
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