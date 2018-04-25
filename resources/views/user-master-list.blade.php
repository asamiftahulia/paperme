@extends('master-dp')
@section('page-title','Customer List')
@section('aktif-muser','active')
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
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Data Master User</h4>
                                    <p class="category">Data master User</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Office</th>
                                            <th>Created By</th>
                                            <th>Updated By</th>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach($data as $datas)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$datas->nik}}</td>
                                                <td>{{$datas->username}}</td>
                                                <td>{{$datas->role}}</td>
                                                <td>{{$datas->office}}</td>
                                                <td>{{$datas->created_by}}</td>
                                                <td>{{$datas->updated_by}}</td>
                                                <td>
                                                    <form action="{{route('user.destroy',$datas->nik)}}" method="post">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}
                                                            <a href="{{route('user.edit',$datas->nik)}}" class="material-icons">mode_edit</a>
                                                            <!-- <a href="{{route('user.index',$datas->nik)}}" class="material-icons">delete</a> -->
                                                          <submit class="material-icons" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">delete</submit>
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