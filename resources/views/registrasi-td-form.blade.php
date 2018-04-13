@extends('master-dp')
@section('page-title','Form Registrasi Time Deposit')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Registration Time Deposit</h4>
                    <p class="category">Time Deposit</p>
                </div>
                <div class="card-content">
                    <form action="{{route('td.store')}}" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <b>Fullname</b>
                                <input type="text" class="form-control" placeholder="Ex: John Doe" name="full_name">
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
                                    <input type="text" class="form-control" name="type_of_td">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                      <b>Status</b>
                                    <input type="text" class="form-control" name="status">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <b>Expired Date</b>
                                     <input id="date" class="date form-control" type="text" name="expired_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <b>Date Rollover</b>
                                    <input type="text" class="form-control" name="date_rollover">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <b>Period</b>
                                    <input type="text" class="form-control" name="period">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <b>Notes</b>
                                    <input type="text" class="form-control" name="notes">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Sign Up</button>
                        <a href="{{URL::to('./')}}" class="btn btn-primary waves-effect ">Back</a>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection