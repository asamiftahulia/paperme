@extends('master')
@section('page-title','Form Add Customer')
@section('content')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Time Deposit Special Rate</h4>
                                    <p class="category">New Customer</p>
                                </div>
                                <div class="card-content">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Fullname</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">ID</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Type</label>
                                                        <div class="form-group">
                                    <input type="radio" name="gender" id="male" class="with-gap">
                                    <label for="new">NEW</label>

                                    <input type="radio" name="gender" id="female" class="with-gap">
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