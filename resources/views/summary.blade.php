@extends('master')
@section('page-title','Summary')
@section('content')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card-profile">
                                        <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Summary</h4>
                                    <p class="category">Time Deposit Special Rate </p>
                                </div>
                                <div class="content">
                                    <h6 class="category text-gray">Customer</h6>
                                    <h4 class="card-title">Fullname </h4>
                                    <p class="card-content">

                                    </p>
                                    <a href="{{URL::to('./test')}}" class="btn btn-primary btn-round">Back</a>
                                    <a href="#pablo" class="btn btn-primary btn-round">Save</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br><br><br><br><br><br>
@endsection