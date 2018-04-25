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
                 <ol class="breadcrumb breadcrumb-bg-cyan align-right">
                                <li class="active"><i class="material-icons">home</i> Registration</a></li>
                                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Summary</a></li>
                                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Timeline</a></li>
                                
                            </ol>
                <div class="card-content">
                    <form action="{{route('td.store')}}" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <b>Fullname</b>
                                <input type="text" class="form-control" placeholder="e.g : John Doe" name="full_name">
                            </div>
                            <div class="col-md-6">
                                <b>Status Deposan</b>
                                <input type="text" class="form-control" name="status" value="NEW" disabled="true">
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-md-4">
                                <b>Amount (Rp)</b>
                                <input type="text" class="form-control" placeholder="Ex: Rp. 99,000" id="amount" name="amount">
                            </div>
                             <div class="col-md-4">
                                <b>Branch</b>
                                <select name="branch" class="form-control">
                                    @foreach($branch as $cabang)
                                        <option value="{{$cabang->id}}">{{$cabang->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <b>Bank</b>
                                <select name="bank" class="form-control">
                                    @foreach($banks as $b)
                                        <option value="{{$b->KODE_LJK}}">{{$b->NAMA_BANK}}</option>
                                    @endforeach
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
                                    <input type="text" class="form-control" id="special_rate" placeholder="e.g: 5.00" name="special_rate">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                      <b>Normal Rate</b>
                                    <input type="text" class="form-control" id="normal_rate" placeholder="e.g : 5.00" name="normal_rate">
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <b>Period</b>
                                    <select name="period" class="form-control">
                                      <option value="1">1</option>
                                      <option value="3">3</option>
                                      <option value="6">6</option>
                                      <option value="12">12</option>
                                    </select>
                                </div>
                            </div>
                              <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <b>Date Rollover</b>
                                    <input type="text" class="form-control" name="date_rollover">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <b>Expired Date</b>
                                     <input class="date form-control" type="text" name="expired_date">
                                </div>
                            </div>
                          
                        
                        </div>
                        <div class="row">
                            <div class="col-md-6">
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
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
   $(function(){
       $('.date').datepicker({

            format: 'mm-dd-yyyy'

        });
    });
</script>
@endsection