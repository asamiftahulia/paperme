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
                    <h4 class="title">Registration Time Deposit Collective</h4>
                    <p class="category"><font color="red">New</font> Time Deposit</p>
                </div>

                <div class="card-content">
                    <?php
                      
                            // echo "<script>alert(".$lastIDMemo['id'].");</script>";
                        
                    ?>

                    
                    <form action="{{route('tdc.store')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <b>Full Name</b>
                                <input type="text" class="form-control" placeholder="e.g : John Doe" name="full_name" required>  
                                <input type="hidden"  name="id_memmo" value='{{$lastIDMemo["id_memmo"]}}'>
                                
                            </div>
                         </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <b>Period (Month)</b>
                                    <select name="period" id="period" class="form-control" onChange="autoFill(); return false;" required>
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
                                <input type="text" class="form-control" placeholder="Ex: Rp. 99,000" id="amount" name="amount" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="form-group label-floating">
                                     <b>Currency</b>
                                    <select name="currency" id="currency" class="form-control" onChange="autoFill(); return false;" required>
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
                                    <input type="number" step="0.01" class="form-control" id="special_rate" placeholder="e.g: 5.00" name="special_rate" required onblur="myFunction()">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                      <b>Normal Rate (%)</b>
                                    <input type="number" step="0.01" class="form-control" id="normal_rate" placeholder="e.g : 5.00" name="normal_rate">
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating"> 
                                    <b>Date Rollover</b>
                                    <input class="form-control" type="date" name="date_rollover" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                     <b>Type Of TD</b>
                                    <select name="type_of_td" class="form-control" required>
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
                                    <option value="000036">--Select--</option>
                                        @foreach($banks as $b)
                                    <option value="{{$b->KODE_LJK}}" data-tokens="{{$b->NAMA_BANK}}">{{$b->NAMA_BANK}}</option>
                                @endforeach
                                </select>
                                <p>Note: Default Bank CCBI</p>
                            </div>
                       
                        <div class="col-md-6">
                                <b>Sumber Dana</b>
                                <input type="file" name="image">
                                <p>Note: If Bank Is Not CCB</p>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <b>Notes</b>
                                    <textarea class="form-control" name="notes" rows="5" id="notes"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info pull-right">
                        <!-- <button type="submit" class="btn btn-info pull-right">Submit</button> -->
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
    <script>
function myFunction() {
 
    var oneM = Number("1000000000");
    var period = document.getElementById('period').value;
    var currency = document.getElementById('currency').value;
    var amount = document.getElementById("amount").value;
    var sr = document.getElementById("special_rate").value;
    var parsAmount = parseFloat(amount.replace(/,/g, ''));
   
if(currency == 'IDR'){
    if(period == 1){
        if(parsAmount > 100000000 && parsAmount <= 1000000000){
             if(sr > 6.50){
                alert("Maksimal Special Rate 6.50 untuk nominal <= 1 bio, Nominal Anda  : " + amount);
                document.getElementById('notes').value = 'Maksimal Special Rate 6.50 untuk nominal <= 1 bio, Nominal Anda  : ' + amount;
                document.getElementById('normal_rate').value = 5.50;
            }else{
                document.getElementById('normal_rate').value = 5.50;
                document.getElementById('notes').value = '';
            }
        }else if(parsAmount > 1000000000){
            if(sr > 6.75){
                alert("Maksimal Special Rate 6.75 untuk nominal > 1 bio, Nominal Anda  : " + amount);
                document.getElementById('notes').value = 'Maksimal Special Rate 6.75 untuk nominal > 1 bio, Nominal Anda  : ' + amount
                document.getElementById('normal_rate').value = 5.50;
            }else{
                document.getElementById('normal_rate').value = 5.50;
                document.getElementById('notes').value = '';
            }
        }
    }else if(period == 3 || period == 6){
        if(parsAmount > 100000000){
            if(sr > 6.75){
                alert("Maksimal Special Rate 6.75, Nominal Anda  : " + amount );
                document.getElementById('notes').value = 'Maksimal Special Rate 6.75, Nominal Anda  : ' + amount ;
                document.getElementById('normal_rate').value = 5.75;
            }else{
                document.getElementById('normal_rate').value = 5.75;
                document.getElementById('notes').value = '';
            }
        }
    }else if(period == 12){
        if(parsAmount > 100000000){
            if(sr > 6.75){
                alert("Maksimal Special Rate 6.75, Nominal Anda  : " + amount );
                document.getElementById('notes').value = 'Maksimal Special Rate 6.75, Nominal Anda  : ' + amount ;
                document.getElementById('normal_rate').value = 6.00;
            }else{
                document.getElementById('normal_rate').value = 6.00;
                document.getElementById('notes').value = '';
            }
        }
    }
}

}
</script>


@endsection