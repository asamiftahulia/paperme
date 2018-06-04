@extends('master-dp')
@section('page-title','Form Registrasi Time Deposit')
@section('aktif-mtimedep','active')
@section('content')
    <ol class="breadcrumb breadcrumb-bg-cyan align-right">
        <li><font color='blue'><i class="material-icons">home</i> Registration</font></li>
        <li><i class="material-icons">library_books</i> Summary</li>
        <li><i class="material-icons">archive</i> Timeline</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Registration Time Deposit</h4>
                    <p class="category"><font color="red">New</font> Time Deposit</p>
                </div>

                <div class="card-content">
                    <form action="{{route('td.store')}}" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <b>Full Name</b>
                                <input type="text" class="form-control" placeholder="e.g : John Doe" name="full_name">
                            </div>
                         </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <b>Period (/ bulan)</b>
                                    <select name="period" id="period" class="form-control" onChange="autoFill(); return false;">
                                    <option>-Select-</option>
                                      <option value="1">1 bln</option>
                                      <option value="3">3 bln</option>
                                      <option value="6">6 bln</option>
                                      <option value="12">12 bln</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <b>Amount</b>
                                <input type="text" class="form-control" placeholder="Ex: Rp. 99,000" id="amount" name="amount">
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="form-group label-floating">
                                     <b>Currency</b>
                                    <select name="currency" id="currency" class="form-control" onChange="autoFill(); return false;">
                                      <option value="IDR">IDR</option>
                                      <option value="USD">USD</option>
                                      <option value="SGD">SGD</option>
                                      <option value="CNY">CNY</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="form-group label-floating">
                                      <b>Special Rate (%)</b>
                                    <input type="number" step="0.01" class="form-control" id="special_rate" placeholder="e.g: 5.00" name="special_rate">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                      <b>Normal Rate (%)</b>
                                    <input type="number" step="0.01" class="form-control" id="normal_rate" placeholder="e.g : 5.00" name="normal_rate">
                                </div>
                            </div> 
                    </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating"> 
                                    <b>Date Rollover</b>
                                    <input class="form-control" type="date" name="date_rollover">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                     <b>Type Of TD</b>
                                    <select name="type_of_td" class="form-control">
                                      <option value="2">Unbreakable</option>
                                      <option value="1">Breakable</op  tion>
                                    </select>
                                </div>
                            </div>
                         </div>
                        
                   
                        <div class="row">
                            <div class="col-md-6">
                                <b>Sources Of Funds</b>
                                <select class="selectpicker form-control" data-live-search="true" name="bank">
                                    <option value="0">--Select--</option>
                                        @foreach($banks as $b)
                                    <option value="{{$b->KODE_LJK}}" data-tokens="{{$b->NAMA_BANK}}">{{$b->NAMA_BANK}}</option>
                                @endforeach
                                </select>
                                <p>Note: Default Bank CCBI</p>
                            </div>
                            
                        </div>
                        <div class="row">
                        <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <b>Notes</b>
                                    <textarea class="form-control" name="notes" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                        <a href="{{URL::to('./')}}" class="btn btn-info waves-effect ">Back</a>
                        <div class="clearfix"></div>
                    </form>
<!-- <table border='1'>
    <tr>
        <th>Term</th>
        <th>Counter Rate</th>
        <th>Area Manager</th>
        <th>Regional Head</th>
        <th>Director</th>
    </tr>
    @foreach($data as $datas)
        <tr>
            <td>{{$datas->term}}</td>
            <td>{{$datas->counter_rate}}</td>
            <td>{{$datas->area_manager}}</td>
            <td>{{$datas->regional_head}}</td>
            <td>{{$datas->director}}</td>
        </tr>
    @endforeach
    </table> -->
                </div>
            </div>
        </div>
    </div>
    <form>
     
<p id="demo" hidden></p>
  <p id="apr" hidden></p>
    </form>

<script type="text/javascript">
  function autoFillByCurrency() {
    var specialRate = document.getElementById('special_rate').value;
    var normalRate = document.getElementById('normal_rate').value;
    var currency = document.getElementById('currency').value;
      document.getElementById('normal_rate').value = 0.50;
    }

  function autoFill() {
    var specialRate = document.getElementById('special_rate').value;
    var normalRate = document.getElementById('normal_rate').value;
    var period = document.getElementById('period').value;
    var currency = document.getElementById('currency').value;
    if(specialRate=='' || specialRate!= ''){
        if(period == 1 || period == 3){
            if(currency == 'IDR'){
            document.getElementById('normal_rate').value = 5.25;
            }else{
                document.getElementById('normal_rate').value = 0.50;
            }
        }
        else if(period == 6 || period == 12){
            if(currency == 'IDR'){
                document.getElementById('normal_rate').value = 5.5;
            }else{
                document.getElementById('normal_rate').value = 0.50;
            }
        }
    }
   
    // var specialRate = document.getElementById('special_rate').value;
    // if(specialRate!='' ){    
       
    // var period = document.getElementById('period').value;
    // var pausecontent = new Array();
    // <?php foreach($data as $datas){ ?>
    //     pausecontent.push('<?php echo $datas; ?>');
    // <?php } ?> 
    // var data ;
    // for(var i = 0; i<pausecontent.length;i++){
    //         pausecontent[i] = JSON.parse(pausecontent[i]);
    //        if(period == pausecontent[i].term){
    //            data = pausecontent[i];
    //            break;
    //        }
    // }
    // //  document.getElementById("demo").innerHTML = data.term;
    //  document.getElementById("demo").innerHTML = data.term + ", " + data.counter_rate + ", " + data.area_manager + ", " + data.regional_head + ", " + data.director;
    
    //  if(specialRate >= data.counter_rate && specialRate <= data.area_manager){
    //     document.getElementById('nr').value = data.counter_rate;
    //     document.getElementById("apr").innerHTML = 'BRANCH MANAGER';
    //  }else if(specialRate >= data.area_manager && specialRate <= data.regional_head){
    //     document.getElementById('nr').value = data.counter_rate;
    //     document.getElementById("apr").innerHTML = 'AREA MANAGER';
    //  }else if(specialRate >= data.regional_head && specialRate <= data.director){
    //     document.getElementById('nr').value = data.counter_rate;
    //     document.getElementById("apr").innerHTML = 'REGIONAL HEAD';
    //  }else if(specialRate > data.director){
    //      document.getElementById('nr').value = data.counter_rate;
    //     document.getElementById("apr").innerHTML = 'DIRECTOR';
    //  }
    // }
  }

</script>

@endsection