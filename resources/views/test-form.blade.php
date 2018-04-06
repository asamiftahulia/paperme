@extends('master')
@section('page-title','Form Add Customer')
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
@section('content')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Time Deposit Special Rate</h4>
                                    <p class="category">New Customer</p>
                                </div>
                                <div class="card-content">
                                <div class="col-md-12 col-md-6">
                                   <form id="form_advanced_validation" method="POST">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="minmaxlength" maxlength="10" minlength="3" required>
                                        <label class="form-label">Min/Max Length</label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 10 characters</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="minmaxvalue" min="10" max="200" required>
                                        <label class="form-label">Min/Max Value</label>
                                    </div>
                                    <div class="help-info">Min. Value: 10, Max. Value: 200</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="url" class="form-control" name="url" required>
                                        <label class="form-label">Url</label>
                                    </div>
                                    <div class="help-info">Starts with http://, https://, ftp:// etc</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="date" required>
                                        <label class="form-label">Date</label>
                                    </div>
                                    <div class="help-info">YYYY-MM-DD format</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="number" required>
                                        <label class="form-label">Number</label>
                                    </div>
                                    <div class="help-info">Numbers only</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="creditcard" pattern="[0-9]{13,16}" required>
                                        <label class="form-label">Credit Card</label>
                                    </div>
                                    <div class="help-info">Ex: 1234-5678-9012-3456</div>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection