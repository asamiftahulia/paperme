@extends('master-dp')
@section('page-title','Summary')
@section('content')
@foreach($data as $datas)
    <!-- <div id="logo">
        <img src="{{asset('css/lo.png')}}">
    </div> -->
    @php
    $month = date('m', strtotime($datas->date_rollover));
    $year = date('y', strtotime($datas->date_rollover));
    @endphp

    <H3 align='center'><b>PERMOHONAN PERSETUJUAN SPECIAL RATE DEPOSITO</b></H3>
    <H4 align='center'>Nomor Surat : 0{{$datas->id}}/CCBI/SR/{{$month}}/{{$year}}</H4>
    <h5>Kepada : REGIONAL</h5>
    <h5>Dari : BRANCH</h5>
    <h5>Tanggal : {{$datas->date_rollover}}</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-profile">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">PERMOHONAN PERSETUJUAN SPECIAL RATE DEPOSITO</h4>
                                    <p class="category">Time Deposit Special Rate </p>
                                </div>
                         
                               
                                <div class="content">
                                      @foreach($data as $datas)
                                    <h6 class="category text-gray">Nomor Surat : {{$datas['id']}}/CCBI</h6>
                                    <p class="card-content" align="center">
                                        Kepada :Regional</br>
                                        Dari   : {{$datas['full_name']}} </br>
                                        Tanggal : 019/CCBI/TIP1/12/18
                                        <!-- Tanggal : {{$datas['expired_date']}} </br> -->
                                    </p>
                                     @endforeach
                                <div class="card-content table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <td>ID</td>
                                            <th>Nama Deposan</th>
                                            <th>Deposan Baru</th>
                                            <th>Nominal Deposito</th>
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
                                                <td>
                                                    @if($datas['status'] == 1)
                                                        {{'NEW'}}
                                                    @else
                                                        {{'EXISTING'}}
                                                    @endif 
                                                </td>
                                                <td>{{$datas['amount']}} </td>
                                                 <td>{{$datas['date_rollover']}} </td>
                                                <td>{{$datas['expired_date']}} </td>
                                                <td>{{$datas['period']}} </td>
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
                                                    @endforeach
                                                </td>
                                            </tr>
                                     
                                         @endforeach
                                          </tbody>
                                    </table>
                                </div>
                                </div>
                                    <a href="{{URL::to('./td')}}" class="btn btn-info btn-round">back</a>
                                     <a href="{{route('td.edit',$datas->id)}}" class="btn btn-info btn-round">Edit</a>
                                     <a href="{{URL::to('td/create')}}" class="btn btn-info btn-round">Add Customer</a>
                                    <a href="{{action('TDController@downloadSummary',1)}}" class="btn btn-info btn-round">Export To PDF</a>
                                    <a href="{{url('timeline',$datas->id)}}" class="btn btn-info btn-round">Submit</a>

                                     
                            </div>
                        </div>
                    </div>
@endsection