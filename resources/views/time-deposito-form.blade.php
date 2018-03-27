@extends('master')
@section('page-title','Form Add Customer')
@section('content')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Time Deposito</h4>
                                    <p class="category">New Time Deposito</p>
                                </div>
                                <div class="card-content">
                                    <form action="{{route('time-deposito.store')}}" method="post">
                                             {{csrf_field()}}
                                        <div class="row">
                                             <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Id Deposito</label>
                                                    <input type="text" class="form-control" name="id_deposito">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Name Time Deposito</label>
                                                    <input type="text" class="form-control" name="name_time_deposit">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Description</label>
                                                    <input type="text" class="form-control" name="description">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                                         <a href="{{URL::to('./')}}" class="btn btn-primary  waves-effect">Back</a>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection