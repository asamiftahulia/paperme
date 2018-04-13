@extends('master')
@section('page-title','Form Add Customer')
@section('content')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Edit Data Master User</h4>
                                    <p class="category">Edit Data User</p>
                                </div>
                                <div class="card-content">
                                     @foreach($data as $datas)
                                <form action="{{route('user.update', $datas->nik) }}" method="post">
                                        {{csrf_field()}}
                                        {{method_field('PUT')}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                <label class="control-label">NIK</label>
                                                <input type="text" class="form-control" name="nik" value="{{ $datas->nik}}">
                                            </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                <label class="control-label">Username</label>
                                                <input type="text" class="form-control" name="username" value="{{$datas->username}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Role</label>
                                                    <input type="text" class="form-control" name="role" value="{{$datas->role}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Office</label>
                                                    <input type="text" class="form-control" name="office" value="{{$datas->office}}">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                         <a href="{{URL::to('./')}}" class="btn btn-primary  waves-effect">Back</a>
                                        <div class="clearfix"></div>
                                    </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
@endsection