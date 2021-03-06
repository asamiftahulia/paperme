@extends('master-dp')
@section('page-title','Form Add Customer')
@section('aktif-muser','active')
@section('content')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Data Master User</h4>
                                    <p class="category">New User</p>
                                </div>
                                <div class="card-content">
                                    <form action="{{route('user.store')}}" method="post">
                                             {{csrf_field()}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                <label class="control-label">NIK</label>
                                                <input type="text" class="form-control" name="nik">
                                            </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                <label class="control-label">Username</label>
                                                <input type="text" class="form-control" name="username">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Role</label>
                                                    <input type="text" class="form-control" name="role">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Office</label>
                                                    <input type="text" class="form-control" name="office">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info pull-right">Proceed</button>
                                         <a href="{{URL::to('./')}}" class="btn btn-info  waves-effect">Back</a>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection