@extends('master-dp')
@section('page-title','Form Master Tipe Deposito')
@section('content')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Tipe Deposito</h4>
                                    <p class="category">New Tipe Deposito</p>
                                </div>
                                <div class="card-content">
                                    <form action="{{route('tipe-deposito.store')}}" method="post">
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
                                                    <label class="control-label">Name Time Deposit</label>
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
                                        <button type="submit" class="btn btn-info pull-right">Save</button>
                                         <a href="{{URL::to('./')}}" class="btn btn-info  waves-effect">Back</a>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection