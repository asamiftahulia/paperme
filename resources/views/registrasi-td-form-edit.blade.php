@extends('master-dp')
@section('page-title','Form Registrasi Time Deposit')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Registration Time Deposit</h4>
                    <p class="category"><font color="red">New</font> Time Deposit</p>
                </div>
                <div class="card-content">
                     @foreach($data as $datas)
                    <form action="{{route('td.update', $datas->id) }}" method="post">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="row">
                            <div class="col-md-12">
                                <b>Fullname</b>
                                <input type="text" class="form-control" placeholder="Ex: John Doe" name="full_name" value="{{ $datas->full_name}}">
                            </div>
                         </div>
                         <div class="row">
                         <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <b>Period</b>
                                    <select name="period" id="period" class="form-control" onChange="autoFill(); return false;">
                                      <option value="1">1 bln</option>
                                      <option value="3">3 bln</option>
                                      <option value="6">6 bln</option>
                                      <option value="12">12 bln</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="form-group label-floating">
                                      <b>Special Rate</b>
                                      <input type="text" class="form-control" name="special_rate" id="special_rate" value="{{ $datas->special_rate}}" onChange="autoFill(); return false;">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                      <b>Normal Rate</b>
                                      <input type="text" class="form-control" name="normal_rate" id="normal_rate" value="{{$datas->normal_rate}}">
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                        <div class="col-md-4">
                                <b>Amount (Rp)</b>
                                <input type="text" class="form-control" placeholder="Ex: Rp. 99,000" id="aing" name="amount" value="{{ $datas->amount}}">
                            </div>
                          
                            <div class="col-md-4">
                                <div class="form-group label-floating"> 
                                    <b>Date Rollover</b>
                                    <input class="form-control" type="date" value="{{ $datas->date_rollover}}" name="date_rollover" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                     <b>Type Of TD</b>
                                    <select name="type_of_td" class="form-control">
                                    @foreach ($tipeDeps as $tipe)
                                        <option @if($tipe->id_deposito == $datas->type_of_td) @endif value="{{$tipe->id_deposito}}">{{$tipe->name_time_deposit}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <b>Sources Of Funds Bank</b>
                                <select class="selectpicker form-control" data-live-search="true">
                                @foreach ($banks as $bank)
                                    <option @if($bank->KODE_LJK == $datas->bank) selected @endif value="{{$bank->KODE_LJK}}">{{$bank->NAMA_BANK}}</option>
                                @endforeach                                           
                                </select>
                            </div>
                            </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <b>Notes</b>

                                    <input type="text" class="form-control" name="notes" placeholder="Write a notes" value="{{ $datas->notes}}">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                        <a href="{{URL::to('./')}}" class="btn btn-info waves-effect ">Back</a>
                        <div class="clearfix"></div>
                        

                    </form>
                     @endforeach
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
  function autoFill() {
      
    var specialRate = document.getElementById('special_rate').value;
    var normalRate = document.getElementById('normal_rate').value;
    var period = document.getElementById('period').value;
    if(specialRate!='' ){ 
        
        if(period == 1 || period == 3)
            document.getElementById('normal_rate').value = 5.25;
        else if(period == 6 || period == 12)
        document.getElementById('normal_rate').value = 5.5;
    
    }
  }

</script>
@endsection