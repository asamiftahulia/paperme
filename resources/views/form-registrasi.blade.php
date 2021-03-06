@extends('master-dp')
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
                                <b>Fullname</b>
                                <input type="text" class="form-control" placeholder="Ex: John Doe" name="fullname">
                            </div>
                           <div class="col-md-6">
                                <b>Amount (Rp)</b>
                                <input type="text" class="form-control" placeholder="Ex: Rp. 99,000" id="aing" name="amount">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                     <b>Type Of TD</b>
                                    <input type="text" class="form-control" name="username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                      <b>Status</b>
                                    <input type="text" class="form-control" name="role">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <b>Expired Date</b>
                                     <input id="date" class="date form-control" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <b>Date Rollover</b>
                                    <input type="text" class="form-control" name="office">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <b>Period</b>
                                    <input type="text" class="form-control" name="office">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <b>Notes</b>
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