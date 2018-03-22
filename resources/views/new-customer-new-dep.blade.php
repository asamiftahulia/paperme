@extends('master')
@section('page-title','New Deposit')
@section('content')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Time Deposit Special Rate</h4>
                                    <p class="category">New Data Time Deposit Special Rate</p>
                                </div>
                                <div class="card-content">
                                    <form action="{{route('timedeposit.store')}}" method="post">
                                         {{csrf_field()}}
                                        <div class="row">
                                              <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Customer ID</label>
                                                    <input type="text" class="form-control" value="{{session('id_cus')}}" name='customer_id'>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Tipe</label>
                                                    <input type="text" class="form-control" name='tipe' value="{{session('tipe')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Bank</label>
                                                    <input type="text" class="form-control" name="bank">
                                                </div>
                                            </div>
                                              <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Amount</label>
                                                    <input type="text" class="form-control" name="amount">
                                                </div>
                                            </div>                                           
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Rate</label>
                                                    <input type="text" class="form-control" name="rate">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Period</label>
                                                    <input type="text" class="form-control" name="period">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">TD</label>
                                                <select class="form-control show-tick" name="td">
                                                    <option value="1">Breakable</option>
                                                    <option value="0">Unbreakable</option>
                                                 </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br><br>
                                        <button type="submit" class="btn btn-primary pull-right">Proceed</button>
                                         <a href="{{URL::to('./')}}" class="btn btn-primary  waves-effect">Back</a>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection