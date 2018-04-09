@extends('master')
@section('page-title','Form Add Customer')
@section('content')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Form Registration Registration </h4>
                                    <p class="category">Special Rate Time Deposit</p>
                                </div>
                                <div class="card-content">
                                    <form action="{{route('customer.store')}}" method="post">
                                             {{csrf_field()}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Fullname</label>
                                                    <input type="text" class="form-control" name="fullname">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">email</label>
                                                    <input type="email" class="form-control" name="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Phone Number</label>
                                                    <input type="text" class="form-control" name="phone_number">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Address</label>
                                                    <input type="text" class="form-control" name="address">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Type</label>
                                                        <div class="form-group">
                                                           
                                                            <input type="radio" name="tipe" id="new" class="with-gap" value="new">
                                                              <label for="new">NEW</label>
                                                            <input type="radio" name="tipe" id="extension" class="with-gap" value="extension">
                                                            <label for="extension" class="m-l-20">EXTENSION</label>
                                                        </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <button type="submit" class="btn btn-primary pull-right">Proceed</button>
                                         <a href="{{URL::to('./')}}" class="btn btn-primary  waves-effect">Back</a>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection