@extends('master')
@section('page-title','Form Time Deposit (TD)')
@section('content')
                    <div class="row">
                        <div class="col-md-12">
                             @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Time Deposit</h4>
                                    <p class="category">New Time Deposit</p>
                                </div>

                                <div class="card-content">
                                    <form action="{{route('time-deposit.store')}}" method="post">
                                             {{csrf_field()}}
                        <div class="body">
                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <div class="col-md-3">
                                        <b>Full Name</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">person</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control money-dollar" placeholder="Ex: John Doe" name="full_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Amount (Rp)</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">attach_money</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control money-dollar" placeholder="Ex: Rp. 99,000" id="aing" name="aing">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Status</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                               <i class="material-icons">check_circle</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control money-euro" placeholder="Ex: True/False" name="status">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Notes</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control credit-card" placeholder="Ex: 0000 0000 0000 0000" name="notes">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Expired Date</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control email" placeholder="Ex: example@example.com" name="expired_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Period</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">vpn_key</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control key" placeholder="Ex: XXX0-XXXX-XX00-0XXX" name="period">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Type Of TD</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">vpn_key</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control key" placeholder="Ex: XXX0-XXXX-XX00-0XXX">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>ID Bank</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">vpn_key</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control key" placeholder="Ex: XXX0-XXXX-XX00-0XXX">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Date Rollover</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">vpn_key</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control key" placeholder="Ex: XXX0-XXXX-XX00-0XXX">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Special Rate</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">vpn_key</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control key" placeholder="Ex: XXX0-XXXX-XX00-0XXX">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Normal Rate</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">vpn_key</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control key" placeholder="Ex: XXX0-XXXX-XX00-0XXX">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Id Branch</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">vpn_key</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control key" placeholder="Ex: XXX0-XXXX-XX00-0XXX">
                                            </div>
                                        </div>
                                    </div>
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
