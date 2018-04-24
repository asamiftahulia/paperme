@extends('master-dp')
@section('page-title','Form Registrasi Time Deposit')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">Registration Time Deposit</h4>
                    <p class="category"><font color="red">New</font> Time Deposit</p>
                </div>
                <div class="card-content">
                     @foreach($data as $datas)
                    <form action="{{route('td.update', $datas->id) }}" method="post">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="row">
                            <div class="col-md-4">
                                <b>Fullname</b>
                                <input type="text" class="form-control" placeholder="Ex: John Doe" name="full_name" value="{{ $datas->full_name}}">
                            </div>
                           <div class="col-md-4">
                                <b>Amount (Rp)</b>
                                <input type="text" class="form-control" placeholder="Ex: Rp. 99,000" id="aing" name="amount" value="{{ $datas->amount}}">
                            </div>
                            <div class="col-md-4">
                                <b>Bank</b>
                                <select name="type_of_td" class="form-control">
                             
                                </select>
                              
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                     <b>Type Of TD</b>
                                    <select name="type_of_td" class="form-control">
                                      <option value="1">Breakable</op  tion>
                                      <option value="2">Unbreakable</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="form-group label-floating">
                                      <b>Special Rate</b>
                                    <input type="text" class="form-control" name="special_rate" value="{{ $datas->special_rate}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                      <b>Normal Rate</b>
                                    <input type="text" class="form-control" name="normal_rate" value="{{ $datas->normal_rate}}">
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <b>Expired Date</b>
                                     <input id="date" class="date form-control" type="text" name="expired_date" value="{{ $datas->expired_date}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <b>Date Rollover</b>
                                    <input type="text" class="form-control" name="date_rollover" value="{{ $datas->date_rollover}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <b>Period</b>
                                    <select name="period" class="form-control">
                                      <option value="6">6</option>
                                      <option value="12">12</option>
                                      <option value="36" selected="selected">36</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <b>Notes</b>
                                    <input type="text" class="form-control" name="notes" placeholder="Write a notes" value="{{ $datas->notes}}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        <a href="{{URL::to('./')}}" class="btn btn-primary waves-effect ">Back</a>
                        <div class="clearfix"></div>
                    </form>
                     @endforeach
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript"></script>
   $(function(){
       $('#date').datepicker({

            format: 'mm-dd-yyyy'

        });
    });

@endsection