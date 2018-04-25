@extends('master-dp')
@section('page-title','Timeline Special Rate')
@section('content')
<div class="col-md-12">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                <div class="card-header" data-background-color="blue">
                  <h4 class="title">TIMELINE</h4>
                  <p class="category">Time Deposit Special Rate </p>
                </div>
                    <div class="header">
                      <ol class="breadcrumb breadcrumb-bg-cyan align-left">
                        <li><i class="material-icons">home</i> Registration</a></li>
                        <li class="active"><i class="material-icons">library_books</i> Summary</a></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Timeline</a></li>
                      </ol>
                      <h3 align="center">
                            Timeline Time Deposit Special Rate
                        </h3>
                        <h5 align="center">
                          
                            @foreach($data as $datas)
                              Name : {{$datas->full_name}} <br>
                              Special Rate : {{$datas->special_rate}}
                            
                            <br>
                            @php
                              $c = 0;
                            @endphp
                            @foreach($apr as $da)
                              Approver : {{$da}}</br>
                              @php $c = $c + 1; @endphp
                            @endforeach
                          
                        </h5>
                    </div>
                 
                    <div class="body">
        <ul class="timeline">
          <!-- Item 1 -->
              @if($c == 1)
                  <li>
                  <div class="direction-r">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Branch Manager</span>
                      <span class="time-wrapper"><span class="time">{{$datas->date_rollover}}</span></span>
                    </div>
                    <div class="desc">Waiting An Action From Branch Manager<br>
                    <button type="button" data-toggle="modal" data-target="#defaultModalDetail"class="btn btn-info btn-round">Detail</button>
                    <button type="button" data-toggle="modal" data-target="#defaultModalApprove"class="btn btn-info btn-round">Approve</button>
                    <button type="button" data-toggle="modal" data-target="#defaultModalReject"class="btn btn-info btn-round">Reject</button>
                    </div>
                  </div>
                </li>
                <div class="modal fade" id="defaultModalDetail" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('td/revisi', $datas->id) }}" method="post">
                            <table class="table">
                              <tr>
                                <th>Fullname</th>
                                <th>Special Rate</th>
                                <th>Amount</th>
                                <th>Fullname</th>
                                <th>Created By</th>
                              </tr>
                              <tr>
                                <td><input type="text" name="" value="{{$datas->full_name}}" class="form-control" disabled></td>
                                <td>
                                  <input type="text" name="special_rate" value="{{$datas->special_rate}}" size="3" />
                                </td>
                                <td>{{$datas->amount}}</td>
                                <td>{{$datas->expired_date}}</td>
                                <td>{{$datas->created_by}}</td>
                              </tr>
                            </table>    
                                               
                     <button type="submit" class="btn btn-info">Revisi</button>
                     </form> 
                          </div>
                      </div>
                  </div>
                </div>
                <div class="modal fade" id="defaultModalApprove" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{route('trx.store')}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan Menyetujui Pengajuan Special Rate <br>
                              Atas Nama {{$datas->full_name}} ? </p>
                              <p><input type="text" enable="false" name="id_td" value="{{$datas->id}}">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-info">Approve</button>
                          </form> 
                          </div>
                      </div>
                  </div>
                </div>
                <div class="modal fade" id="defaultModalReject" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{route('trx.store')}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'>Menolak</font> Pengajuan Special Rate <br>
                              Atas Nama {{$datas->full_name}} ? </p>
                              <p><input type="text" enable="false" name="id_td" value="{{$datas->id}}">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-info">Reject</button>
                          </form> 
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Item 2 -->
                <li>
                  <div class="direction-l">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Area</span>
                      <span class="time-wrapper"><span class="time">{{$datas->date_rollover}}</span></span>
                    </div>
                    <div class="desc">Waiting An Action From Area<br>
                      <button type="button" data-toggle="modal" data-target="#defaultModalDetail"class="btn btn-info btn-round">Detail</button>
                      <button type="button" data-toggle="modal" data-target="#defaultModalApprove"class="btn btn-info btn-round">Approve</button>
                      <button type="button" data-toggle="modal" data-target="#defaultModal"class="btn btn-info btn-round">Reject</button>
                    </div>
                  </div>
                </li>
                <div class="modal fade" id="defaultModalDetail" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('td/revisi', $datas->id) }}" method="post">
                            <table class="table">
                              <tr>
                                <th>Fullname</th>
                                <th>Special Rate</th>
                                <th>Amount</th>
                                <th>Fullname</th>
                                <th>Created By</th>
                              </tr>
                              <tr>
                                <td><input type="text" name="" value="{{$datas->full_name}}" class="form-control" disabled></td>
                                <td>
                                  <input type="text" name="special_rate" value="{{$datas->special_rate}}" size="3" />
                                </td>
                                <td>{{$datas->amount}}</td>
                                <td>{{$datas->expired_date}}</td>
                                <td>{{$datas->created_by}}</td>
                              </tr>
                            </table>    
                                               
                     <button type="submit" class="btn btn-info">Revisi</button>
                     </form> 
                          </div>
                      </div>
                  </div>
                </div>
                <div class="modal fade" id="defaultModalApprove" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{route('trx.store')}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan Menyetujui Pengajuan Special Rate <br>
                              Atas Nama {{$datas->full_name}} ? </p>
                              <p><input type="text" enable="false" name="id_td" value="{{$datas->id}}">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-info">Approve</button>
                          </form> 
                          </div>
                      </div>
                  </div>
                </div>
                <div class="modal fade" id="defaultModalReject" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{route('trx.store')}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'>Menolak</font> Pengajuan Special Rate <br>
                              Atas Nama {{$datas->full_name}} ? </p>
                              <p><input type="text" enable="false" name="id_td" value="{{$datas->id}}">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-info">Reject</button>
                          </form> 
                          </div>
                      </div>
                  </div>
                </div>
              @elseif($c == 2)
                <li>
                  <div class="direction-r">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Branch Manager</span>
                      <span class="time-wrapper"><span class="time">Januari 2019</span></span>
                    </div>
                    <div class="desc">Waiting An Action From Branch Manager<br>
                    <button type="button" data-toggle="modal" data-target="#defaultModalDetail"class="btn btn-info btn-round">Detail</button>
                    <button type="button" data-toggle="modal" data-target="#defaultModalApprove"class="btn btn-info btn-round">Approve</button>
                    <button type="button" data-toggle="modal" data-target="#defaultModal"class="btn btn-info btn-round">Reject</button>
                    </div>
                    </div>

                  </div>
                </li>
                <!-- Item 2 -->
                <li>
                  <div class="direction-l">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Area</span>
                      <span class="time-wrapper"><span class="time">Januari 2019</span></span>
                    </div>
                    <div class="desc">Waiting An Action From Area<br>
                    <button type="button" data-toggle="modal" data-target="#defaultModalDetail"class="btn btn-info btn-round">Detail</button>
                    <button type="button" data-toggle="modal" data-target="#defaultModalApprove"class="btn btn-info btn-round">Approve</button>
                    <button type="button" data-toggle="modal" data-target="#defaultModal"class="btn btn-info btn-round">Reject</button>
                    </div>
                  </div>
                </li>
                 <!-- Item 3 -->
                <li>
                  <div class="direction-r">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Regional</span>
                      <span class="time-wrapper"><span class="time">Januari 2019</span></span>
                    </div>
                    <div class="desc">Waiting An Action From Regional<br>
                    <button type="button" data-toggle="modal" data-target="#defaultModalDetail"class="btn btn-info btn-round">Detail</button>
                    <button type="button" data-toggle="modal" data-target="#defaultModalApprove"class="btn btn-info btn-round">Approve</button>
                    <button type="button" data-toggle="modal" data-target="#defaultModal"class="btn btn-info btn-round">Reject</button>
                    </div>
                  </div>
                </li>
                @else
                 <li>
                  <div class="direction-r">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Branch Manager</span>
                      <span class="time-wrapper"><span class="time">Januari 2019</span></span>
                    </div>
                    <div class="desc">Waiting An Action From Branch Manager<br>
                    <button type="button" data-toggle="modal" data-target="#defaultModalDetail"class="btn btn-info btn-round">Detail</button>
                    <button type="button" data-toggle="modal" data-target="#defaultModalApprove"class="btn btn-info btn-round">Approve</button>
                    <button type="button" data-toggle="modal" data-target="#defaultModal"class="btn btn-info btn-round">Reject</button>
                    </div>
                    </div>

                  </div>
                </li>
                <!-- Item 2 -->
                <li>
                  <div class="direction-l">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Area</span>
                      <span class="time-wrapper"><span class="time">Januari 2019</span></span>
                    </div>
                    <div class="desc">Waiting An Action From Area<br>
                    <button type="button" data-toggle="modal" data-target="#defaultModalDetail"class="btn btn-info btn-round">Detail</button>
                    <button type="button" data-toggle="modal" data-target="#defaultModalApprove"class="btn btn-info btn-round">Approve</button>
                    <button type="button" data-toggle="modal" data-target="#defaultModal"class="btn btn-info btn-round">Reject</button>
                    </div>
                  </div>
                </li>
                 <!-- Item 3 -->
                <li>
                  <div class="direction-r">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Regional</span>
                      <span class="time-wrapper"><span class="time">{{$datas->date_rollover}}</span></span>
                    </div>
                    <div class="desc">Waiting An Action From Regional<br>
                    <button type="button" data-toggle="modal" data-target="#defaultModalDetail"class="btn btn-info btn-round">Detail</button>
                    <button type="button" data-toggle="modal" data-target="#defaultModalApprove"class="btn btn-info btn-round">Approve</button>
                    <button type="button" data-toggle="modal" data-target="#defaultModal"class="btn btn-info btn-round">Reject</button>
                    </div>
                  </div>
                </li>
                  <li>
                  <div class="direction-l">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Direktur</span>
                      <span class="time-wrapper"><span class="time">{{$datas->date_rollover}}</span></span>
                    </div>
                    <div class="desc">Waiting An Action From Director<br>
                    <button type="button" data-toggle="modal" data-target="#defaultModalDetail"class="btn btn-info btn-round">Detail</button>
                    <button type="button" data-toggle="modal" data-target="#defaultModalApprove"class="btn btn-info btn-round">Approve</button>
                    <button type="button" data-toggle="modal" data-target="#defaultModal"class="btn btn-info btn-round">Reject</button>
                    </div>
                  </div>
                </li>
              @endif
             @endforeach
           
               
          
          
        
        </ul>
 </div>
</div>
</div>
</div>
</div> 
@endsection
