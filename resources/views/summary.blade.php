@extends('master-dp')
@section('page-title','Summary')
@section('aktif-mtimedep','active')
@section('content')
                <ol class="breadcrumb breadcrumb-bg-cyan align-left">
                    <li><i class="material-icons">home</i> Registration</a></li>
                    <li class="active"><i class="material-icons">library_books</i> Summary</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Timeline</a></li>
                </ol>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-profile">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">PERMOHONAN PERSETUJUAN SPECIAL RATE DEPOSITO</h4>
                                    <p class="category">Time Deposit Special Rate </p>
                                </div>
                         
                               
                                <div class="content">
                                        <?php
                                        $temp = 0;
                                            foreach($apr as $da){
                                                $temp = $da;
                                            }
                                        ?>
                                      @foreach($data as $datas)
                                    <h6 class="category text-gray">Nomor Surat : {{$datas['id']}}/CCBI</h6>
                                    <p class="card-content" align="center">
                                        Kepada :{{$temp}}</br>
                                        Dari   : {{$datas['created_by']}} </br>
                                        <!-- Tanggal : 019/CCBI/TIP1/12/18 -->
                                    </p>
                                     @endforeach
                                <div class="card-content table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <td>ID</td>
                                            <th>Nama Deposan</th>
                                            <!-- <th>Deposan Baru</th> -->
                                            <th>Nominal Deposito </th>
                                            <th>Tgl Penempatan</th>
                                            <th>Tgl Jatuh Tempo</th>
                                            <th>Period</th>
                                            <th>Type Of TD</th>
                                            <th>Normal Rate (%)</th>
                                            <th>Special Rate (%)</th>
                                            <!-- <th>Bank Asal</th> -->
                                            <th>Keterangan</th>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            <tr>
                                                @foreach($data as $datas)
                                                <td>{{$datas['id']}} </td>
                                                <td>{{$datas['full_name']}} </td>
                                                <!-- <td>
                                                    @if($datas['status'] == 1)
                                                        {{'EXISTING'}}
                                                    @else
                                                        {{'NEW'}}
                                                    @endif 
                                                </td> -->
                                                <td>{{number_format($datas['amount'],2)}} ({{$datas['currency']}})</td>
                                                 <td>{{$datas['date_rollover']}} </td>
                                                <td>{{$datas['expired_date']}} </td>
                                                <td>{{$datas['period']}} Bln</td>
                                                <td>@php 
                                                        if($datas['type_of_td']==1)
                                                            echo 'Breakable';
                                                        else
                                                            echo 'Unbreakable';
                                                    @endphp
                                                         </td>
                                                 <td>{{$datas['normal_rate']}} %</td>
                                                <td>{{$datas['special_rate']}} %</td>
                                               
                                                 <!-- <td>{{$datas['bank']}} </td> -->
                                              <td><a class="material-icons" data-toggle="modal" data-target="#defaultModal">pageview</a></td>
                                              <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Keterangan</h4>
                          </div>
                          <div class="modal-body">
                          
                            {{csrf_field()}}
                            <p>{{$datas['notes']}} <br>
                         
                          </div>
                      </div>
                  </div>
                </div>
            </tr>
                                            <tr bgcolor="#21daf9">
                                                <td colspan="12">
                                                    Approver
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="12">
                                                    @foreach($apr as $da)
                                                        {{$da}}
                                                        </br>
                                                    @endforeach
                                                </td>
                                            </tr>
                                     
                                         @endforeach
                                          </tbody>
                                    </table>
                                </div>
                                </div>
                                    <!-- <a href="{{URL::to('./td')}}" class="btn btn-info btn-round">back</a> -->
                                     <a href="{{route('td.edit',$datas->id)}}" class="btn btn-info btn-round">BACK</a>
                                     <!-- <a href="{{URL::to('td/create')}}" class="btn btn-info btn-round">Add Customer</a> -->
                                    <a href="{{url('timeline',$datas->id)}}" class="btn btn-info btn-round">GO TO TIMELINE</a>
                                    <a href="{{url('CollectiveNewTD',$datas->id)}}" class="btn btn-info btn-round">Add More</a>
                               
                            </div>
                        </div>
                    </div>
@endsection