@extends('master')
@section('page-title','Form Add Customer')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Registration Time Deposit</h4>
                    <p class="category">Time Deposit</p>
                </div>
                <div class="card-content">
                    <form action="{{route('user.store')}}" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Fullname</label>
                                    <input type="text" class="form-control" name="nik">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Amount</label>
                                    <input type="text" class="form-control" name="username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Type Of TD</label>
                                    <input type="text" class="form-control" name="username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Status</label>
                                    <input type="text" class="form-control" name="role">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Expired Date</label>
                                    <input type="text" class="form-control" name="office">
                                </div>
                            </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Date Rollover</label>
                                    <input type="text" class="form-control" name="office">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Period</label>
                                    <input type="text" class="form-control" name="office">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Notes</label>
                                    <input type="text" class="form-control" name="office">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Proceed</button>
                        <a href="{{URL::to('./')}}" class="btn btn-primary waves-effect ">Back</a>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection