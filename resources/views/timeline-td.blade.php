@extends('master-dp')
@section('page-title','Timeline Special Rate')
@section('content')

<ol class="breadcrumb breadcrumb-bg-cyan align-left">
                        <li><i class="material-icons">home</i> Registration</a></li>
                        <li class="active"><i class="material-icons">library_books</i> Summary</a></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Timeline</a></li>
                      </ol>
<div class="col-md-12">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                <div class="card-header" data-background-color="blue">
                  <h4 class="title">TIMELINE</h4>
                  <p class="category">Time Deposit Special Rate {{$valButton}}{{$trx}} </p>
                  </div>
                    <div class="header">

                      <h3 align="center">
                            Timeline Time Deposit Special Rate
                        </h3>
                        <h5>
                        @foreach($data as $datas)
                          <table align="center">
                            <tr>
                              <td>Name  </td>
                              <td> : </td>
                              <td> {{$datas->full_name}} </td>
                            </tr>
                            <tr>
                              <td>Special Rate</td>
                              <td> : </td>
                              <td> {{$datas->special_rate}}</td>
                            </tr>
                            <tr>
                              <td>Period</td>
                              <td> : </td>
                              <td> {{$datas->period}} Bulan</td>
                            </tr>
                            @php
                               $c = 0;
                                @endphp
                              @foreach($apr as $da)
                                @php $c = $c + 1;
                            @endphp
                          </table>
                            @endforeach
                        </h5>
                    </div>
                    <div class="body">
          <!-- Item 1 -->
              @if($c == 1)
              <ul class="timeline">
                  <li>
                  <div class="direction-r">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Branch Manager</span>
                      <span class="time-wrapper"><span class="time" id="time">-</span></span>
                    </div>
                    <div class="desc"><p id="actionBM1">Waiting An Action From Branch Manager</p><br>
                      <input type="button" id="btn-revisi-bm1" data-toggle="modal" data-target="#modalDetailBM" class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id="btn-approve-bm1" value="Approve" data-toggle="modal" data-target="#modalAprBM"class="btn btn-success btn-sm"  >
                      <input type="button" id="btn-reject-bm1" data-toggle="modal" data-target="#modalRejBM"class="btn btn-danger btn-sm" value="Reject">
                    </div>
                  </div>
                </li>
                <!-- Revisi -->
                <div class="modal fade" id="modalDetailBM" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                          </div>
                          <div class="modal-body">
                            <!-- <form action="{{url('td/revisi',$datas->id)}}" method="post"> -->
                            <form action="{{url('trx/revisi',$datas->id)}}" method="post">
                            {{ csrf_field() }}
                            <table class="table">
                              <tr>
                                <th>Fullname</th>
                                <th>Special Rate</th>
                                <th>Amount</th>
                                <th>Expired Date</th>
                                <th>Created By</th>
                              </tr>
                              <tr>
                                <td>{{$datas->full_name}} </td>
                                <td>
                                  <input type="text" name="special_rate" value="{{$datas->special_rate}}" size="3" />
                                </td>
                                <input type="hidden" enable="false" name="role" value="Branch Manager">
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
                <!-- Approve -->
                <div class="modal fade" id="modalAprBM" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{route('trx.store')}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color="green"><b>Menyetujui</b></font> Pengajuan Special Rate <br>
                               <b> {{$datas->full_name}} </b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Branch Manager">
                              <input type="hidden" enable="false" name="special_rate" value="{{$datas->special_rate}}">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" onclick="autoDisable();" class="btn btn-success">Approve</button>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modalRejBM" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak</b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Branch Manager">
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
                      <span class="flag">Area Manager</span>
                      <span class="time-wrapper"><span class="time" id="approved-date-by-am1">-</span></span>
                    </div>
                    <div class="desc"><p id="act">Waiting An Action From Branch Manager</p><br>
                      <button type="button" id="btn-revisi-am1"data-toggle="modal" data-target="#modalDetailAM"class="btn btn-info btn-sm">Detail</button>
                      <button type="button" id="btn-approve-am1" data-toggle="modal" data-target="#modalAprAM"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" id="btn-reject-am1" data-toggle="modal" data-target="#modalRejAM"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                    
                  </div>
                </li>
              </ul>
              <!-- Revisi -->
                <div class="modal fade" id="modalDetailAM" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('trx/revisi', $datas->id) }}" method="post">
                            {{csrf_field()}}  
                            <table class="table">
                              <tr>
                                <th>Fullname</th>
                                <th>Special Rate</th>
                                <th>Amount</th>
                                <th>Expired Date</th>
                                <th>Created By</th>
                              </tr>
                              <tr>
                                <td><input type="text" name="" value="{{$datas->full_name}}" class="form-control" disabled></td>
                                <td>
                                  <input type="hidden" enable="false" name="role" value="Area Manager">
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
                <div class="modal fade" id="modalAprAM" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{route('trx.store')}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color="green"><b>Menyetujui</b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Area Manager">
                              <input type="hidden" enable="false" name="special_rate" value="{{$datas->special_rate}}">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-success">Approve</button>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="modal fade" id="modalRejAM" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('trx/reject',$datas->id)}}" method="post">
                              {{csrf_field()}}
                              <p>Apakah Benar Anda Akan <font color='red'><b>Menolak</b></font> Pengajuan Special Rate <br>
                                Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                                <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                                <input type="hidden" enable="false" name="role" value="Area Manager">
                              <button type="button" class="btn btn-info">Cancel</button>
                              <button type="submit" class="btn btn-info">Reject</button>
                            </form>
                          </div>
                      </div>
                  </div>
                </div>
              @elseif($c == 2)
              <ul class="timeline">
                <!-- Item 1 -->
                <li>
                  <div class="direction-r">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Branch Manager</span>
                      <span class="time-wrapper"><span class="time" id="approved-date-by-bm2">-</span></span>
                    </div>
                    <div class="desc"><p id='act-bm2'>Waiting An Action From Branch Manager</p><br>
                      <input type="button" id="btn-revisi-bm2"  data-toggle="modal" data-target="#modal2BMDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id="btn-approve-bm2" data-toggle="modal" id="btn-approve-bm" data-target="#modal2BMApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" id="btn-reject-bm2" data-toggle="modal" data-target="#modal2BMRej"class="btn btn-danger btn-sm" value="Reject">
                    </div>
                  </div>
                </li>
                <!-- Detail -->
                <div class="modal fade" id="modal2BMDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('trx/revisi', $datas->id) }}" method="post">
                            {{ csrf_field() }}
                            <table class="table">
                              <tr>
                                <th>Fullname</th>
                                <th>Special Rate</th>
                                <th>Amount</th>
                                <th>Expired Date</th>
                                <th>Created By</th>
                              </tr>
                              <tr>
                                <td><input type="text" name="" value="{{$datas->full_name}}" class="form-control" disabled></td>
                                <td>
                                <input type="hidden" name="role" value="Branch Manager"/>
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
                <!-- Approve -->
                <div class="modal fade" id="modal2BMApr" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{route('trx.store')}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color="green"><b>Menyetujui</b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Branch Manager">
                              <input type="hidden" enable="false" name="special_rate" value="{{$datas->special_rate}}">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-success">Approve</button>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modal2BMRej" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak</b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Branch Manager">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-success">Reject</button>
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
                      <span class="flag">Area Manager</span>
                      <span class="time-wrapper"><span class="time" id="approved-date-by-am2">-</span></span>
                    </div>
                    <div class="desc"><p id="act-am2">Waiting An Action From Area Manager</p><br>
                      <input type="button" id ="btn-revisi-am2" data-toggle="modal" data-target="#modal2AMDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id ="btn-approve-am2" data-toggle="modal" data-target="#modal2AMApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" id ="btn-reject-am2" data-toggle="modal" data-target="#modal2AMRej"class="btn btn-danger btn-sm" value="Reject">
                    </div>
                  </div>
                </li>
                <!-- Detail -->
                <div class="modal fade" id="modal2AMDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('trx/revisi', $datas->id) }}" method="post">
                            {{csrf_field()}}
                            <table class="table">
                              <tr>
                                <th>Fullname</th>
                                <th>Special Rate</th>
                                <th>Amount</th>
                                <th>Expired Date</th>
                                <th>Created By</th>
                              </tr>
                              <tr>
                                <td><input type="text" name="" value="{{$datas->full_name}}" class="form-control" disabled></td>
                                <td>
                                <input type="hidden" name="role" value="Area Manager"/>
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
                <!-- Approve -->
                <div class="modal fade" id="modal2AMApr" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{route('trx.store')}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color="green"><b>Menyetujui</b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Area Manager">
                              <input type="hidden" enable="false" name="special_rate" value="{{$datas->special_rate}}">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-success">Approve</button>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modal2AMRej" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak</b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Area Manager">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-success">Approve</button>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Item 3 -->
                <li>
                  <div class="direction-r">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Regional Head</span>
                      <span class="time-wrapper"><span class="time" id="approved-date-by-rh2">-</span></span>
                    </div>
                    <div class="desc"><p id="act-rh2">Waiting An Action From Regional Head</p><br>
                      <input type="button" id="btn-revisi-rh2" data-toggle="modal" data-target="#modal2RHDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id ="btn-approve-rh2" data-toggle="modal" data-target="#modal2RHApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" id ="btn-reject-rh2" data-toggle="modal" data-target="#modal2RHRej"class="btn btn-danger btn-sm" value="Reject">
                    </div>
                  </div>
                </li>
                <div class="modal fade" id="modal2RHDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('trx/revisi', $datas->id) }}" method="post">
                            {{csrf_field()}}
                            <table class="table">
                              <tr>
                                <th>Fullname</th>
                                <th>Special Rate</th>
                                <th>Amount</th>
                                <th>Expired Date</th>
                                <th>Created By</th>
                              </tr>
                              <tr>
                                <td><input type="text" name="" value="{{$datas->full_name}}" class="form-control" disabled></td>
                                <td>
                                <input type="hidden" name="role" value="Regional Head"/>
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
                <!-- Approve -->
                <div class="modal fade" id="modal2RHApr" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{route('trx.store')}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color="green"><b>Menyetujui</b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                              <p><input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Regional Head">
                              <input type="hidden" enable="false" name="special_rate" value="{{$datas->special_rate}}">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-success">Approve</button>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modal2RHRej" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak</b></font>Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Regional Head">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-info">Reject</button>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
              </ul>
                @else
                <ul class="timeline">
                <!-- Item 1 -->
                <li>
                  <div class="direction-r">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Branch Manager</span>
                      <span class="time-wrapper"><span class="time" id="approved-date-by-bm3">-</span></span>
                    </div>
                    <div class="desc"><p id="act-bm3">Waiting An Action From Area<br></p>
                      <input type="button" id="btn-revisi-bm3" data-toggle="modal" data-target="#modal2BMDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id="btn-approve-bm3"data-toggle="modal" id="btn-approve-bm" data-target="#modal2BMApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" id="btn-reject-bm3"data-toggle="modal" data-target="#modal2BMRej"class="btn btn-danger btn-sm" value="Reject">
                    </div>
                  </div>
                </li>
                <div class="modal fade" id="modal2BMDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('trx/revisi', $datas->id) }}" method="post">
                            {{csrf_field()}}
                            <table class="table">
                              <tr>
                                <th>Fullname</th>
                                <th>Special Rate</th>
                                <th>Amount</th>
                                <th>Expired Date</th>
                                <th>Created By</th>
                              </tr>
                              <tr>
                                <td><input type="text" name="" value="{{$datas->full_name}}" class="form-control" disabled></td>
                                <td>
                                <input type="hidden" name="role" value="Branch Manager"/>
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
                <!-- Approve -->
                <div class="modal fade" id="modal2BMApr" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{route('trx.store')}}" method="post">
                           {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color="green"><b>Menyetujui</b></font> Pengajuan Special Rate <br>
                              Atas Nama <b>{{$datas->full_name}}</b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Branch Manager">
                              <input type="hidden" enable="false" name="special_rate" value="{{$datas->special_rate}}">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-info">Approve</button>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modal2BMRej" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                           {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak</b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}}</b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Branch Manager">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-success">Reject</button>
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
                      <span class="flag">Area Manager</span>
                      <span class="time-wrapper"><span class="time" id="approved-date-by-am3">-</span></span>
                    </div>
                    <div class="desc"><p id="act-am3">Waiting An Action From Area Manager<br></p>
                      <input type="button" id="btn-revisi-am3" data-toggle="modal" data-target="#modal2AMDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id="btn-approve-am3" data-toggle="modal" data-target="#modal2AMApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" id="btn-reject-am3" data-toggle="modal" data-target="#modal2AMRej"class="btn btn-danger btn-sm" value="Reject">
                    </div>
                  </div>
                </li>
                <!-- Detail -->
                <div class="modal fade" id="modal2AMDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('trx/revisi', $datas->id) }}" method="post">
                            {{csrf_field()}}
                            <table class="table">
                              <tr>
                                <th>Fullname</th>
                                <th>Special Rate</th>
                                <th>Amount</th>
                                <th>Expired Date</th>
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
                <!-- Approve -->
                <div class="modal fade" id="modal2AMApr" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{route('trx.store')}}" method="post">
                           {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color="green"><b>Menyetujui</b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}}</b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Area Manager">
                              <input type="hidden" enable="false" name="special_rate" value="{{$datas->special_rate}}">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-success">Approve</button>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modal2AMRej" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                           {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak</b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Area Manager">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-success">Reject</button>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Item 3 -->
                <li>
                  <div class="direction-r">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Regional Head</span>
                      <span class="time-wrapper"><span class="time" id="approved-date-by-rh3">-</span></span>
                    </div>
                    <div class="desc"><p id="act-rh3">Waiting An Action From Regional Head<br></p>
                      <input type="button" id="btn-revisi-rh3" data-toggle="modal" data-target="#modal2RHDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id="btn-approve-rh3" data-toggle="modal" data-target="#modal2RHApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" id="btn-reject-rh3" data-toggle="modal" data-target="#modal2RHRej"class="btn btn-danger btn-sm" value="Reject">
                    </div>
                  </div>
                </li>
                <div class="modal fade" id="modal2RHDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('trx/revisi', $datas->id) }}" method="post">
                            {{csrf_field()}}
                            <table class="table">
                              <tr>
                                <th>Fullname</th>
                                <th>Special Rate</th>
                                <th>Amount</th>
                                <th>Expired Date</th>
                                <th>Created By</th>
                              </tr>
                              <tr>
                                <td><input type="text" name="" value="{{$datas->full_name}}" class="form-control" disabled></td>
                                <td>
                                <input type="text" name="role" value="Regional Head"/>
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
                <!-- Approve -->
                <div class="modal fade" id="modal2RHApr" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{route('trx.store')}}" method="post">
                           {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color="green"><b>Menyetujui</b></font> Pengajuan Special Rate <br>
                              Atas Nama <b>{{$datas->full_name}} </b>? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Regional Head">
                              <input type="hidden" enable="false" name="special_rate" value="{{$datas->special_rate}}">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-success">Approve</button>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modal2RHRej" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                           {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak</b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                             <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                             <input type="hidden" enable="false" name="role" value="Regional Head">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-success">Reject</button>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- List 4 -->
                <li>
                  <div class="direction-l">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Director</span>
                      <span class="time-wrapper"><span class="time" id="approved-date-by-dr3">-</span></span>
                    </div>
                    <div class="desc"><p id="act-dr3">Waiting An Action From Regional Head<br></p>
                      <input type="button" id="btn-revisi-dr3" data-toggle="modal" data-target="#modal2DirDet" class="btn btn-sm btn-info" value="Detail">
                      <input type="button" id="btn-approve-dr3" data-toggle="modal" data-target="#modal2DirApr" class="btn btn-sm btn-success" value="Approve">
                      <input type="button" id="btn-reject-dr3" data-toggle="modal" data-target="#modal2DirRej" class="btn btn-sm btn-danger" value="Reject">
                    </div>
                  </div>
                </li>
                <div class="modal fade" id="modal2DirDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('trx/revisi', $datas->id) }}" method="post">
                            {{csrf_field()}}
                            <table class="table">
                              <tr>
                                <th>Fullname</th>
                                <th>Special Rate</th>
                                <th>Amount</th>
                                <th>Expired Date</th>
                                <th>Created By</th>
                              </tr>
                              <tr>
                                <td><input type="text" name="" value="{{$datas->full_name}}" class="form-control" disabled></td>
                                <td>
                                <input type="hidden" name="role" value="Director"/>
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
                <!-- Approve -->
                <div class="modal fade" id="modal2DirApr" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{route('trx.store')}}" method="post">
                           {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color="green"><b>Menyetujui</b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" name="special_rate" value="{{$datas->special_rate}}">
                              <input type="hidden" name="role" value="Director">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-success">Approve</button>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modal2DirRej" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak</b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}}</b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Director">
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-success">Reject</button>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
              </ul>
              @endif
             @endforeach
            </div></br></br></br></br></br>
            <div class="row" align="center">
                <a align="center" href="{{route('td.index')}}"><input type="button" id="btn-submit" class="btn btn-info" value="Submit"></a>
                <a align="center" href="{{url('td/updateStatus',$datas->id)}}"><input type="button" id="btn-finish" disabled="true" class="btn btn-info" value="Finish"></a>
            </div>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

if(dd<10) {
    dd = '0'+dd
} 

if(mm<10) {
    mm = '0'+mm
} 

today = mm + '-' + dd + '-' + yyyy;

var jumlahApr = '<?php echo $jumlahApr; ?>';
var approver = '<?php echo $valButton; ?>'
var bm = '<?php echo $approverBM; ?>'
var am = '<?php echo $approverAM; ?>'
var rh = '<?php echo $approverRH;?>'
var dr = '<?php echo $approverDR;?>'

console.log('Jumlah Approver: ', jumlahApr);
console.log('approverBM: ', bm);
console.log('approverAM: ', am);
console.log('approverRH: ', rh);
$("input").click(function(e){
    var idClicked = e.target.id;
    console.log('idclicked:', idClicked);
});

  function autoDisableBM1() {    
    document.getElementById("btn-approve-bm1").disabled = true;
    document.getElementById("btn-revisi-bm1").disabled = true;
    document.getElementById("btn-reject-bm1").disabled = true;
    document.getElementById("time").innerHTML = today;
    document.getElementById("actionBM1").innerHTML = "This Special Rate Has Been Approved by Branch Manager";
  }

  function autoDisableAM1() {
    document.getElementById("btn-approve-am1").disabled = true;
    document.getElementById("btn-revisi-am1").disabled = true;
    document.getElementById("btn-reject-am1").disabled = true;
    document.getElementById("btn-finish").disabled = false;
    document.getElementById("approved-date-by-am1").innerHTML = today;
    document.getElementById("act").innerHTML = "This Special Rate Has Been Approved by Area Manager";
  }

  // 3 approver 
   function autoDisableBM2() {
    document.getElementById("btn-approve-bm2").disabled = true;
    document.getElementById("btn-revisi-bm2").disabled = true;
    document.getElementById("btn-reject-bm2").disabled = true;
    document.getElementById("approved-date-by-bm2").innerHTML = today;
    document.getElementById("act-bm2").innerHTML = "This Special Rate Has Been Approved by Branch Manager";
  }

  function autoDisableAM2() {
    document.getElementById("btn-approve-am2").disabled = true;
    document.getElementById("btn-revisi-am2").disabled = true;
    document.getElementById("btn-reject-am2").disabled = true;
    document.getElementById("approved-date-by-am2").innerHTML = today;
    document.getElementById("act-am2").innerHTML = "This Special Rate Has Been Approved by Area Manager";
  }

   function autoDisableRH2() {
    document.getElementById("btn-approve-rh2").disabled = true;
    document.getElementById("btn-revisi-rh2").disabled = true;
    document.getElementById("btn-reject-rh2").disabled = true;
    document.getElementById("approved-date-by-rh2").innerHTML = today;
    document.getElementById("act-rh2").innerHTML = "This Special Rate Has Been Approved by Area Manager";
  }

  // approver 4

   function autoDisableBM3() {
    document.getElementById("btn-approve-bm3").disabled = true;
    document.getElementById("btn-revisi-bm3").disabled = true;
    document.getElementById("btn-reject-bm3").disabled = true;
    document.getElementById("approved-date-by-bm3").innerHTML = today;
    document.getElementById("act-bm3").innerHTML = "This Special Rate Has Been Approved by Branch Manager";
  }

  function autoDisableAM3() {
    document.getElementById("btn-approve-am3").disabled = true;
    document.getElementById("btn-revisi-am3").disabled = true;
    document.getElementById("btn-reject-am3").disabled = true;
    document.getElementById("approved-date-by-am3").innerHTML = today;
    document.getElementById("act-am3").innerHTML = "This Special Rate Has Been Approved by Area Manager";
  }

   function autoDisableRH3() {
    document.getElementById("btn-approve-rh3").disabled = true;
    document.getElementById("btn-revisi-rh3").disabled = true;
    document.getElementById("btn-reject-rh3").disabled = true;
    document.getElementById("approved-date-by-rh3").innerHTML = today;
    document.getElementById("act-rh3").innerHTML = "This Special Rate Has Been Approved by Area Manager";
  }

   function autoDisableDR3() {
    document.getElementById("btn-approve-dr3").disabled = true;
    document.getElementById("btn-revisi-dr3").disabled = true;
    document.getElementById("btn-reject-dr3").disabled = true;
    document.getElementById("approved-date-by-dr3").innerHTML = today;
    document.getElementById("act-dr3").innerHTML = "This Special Rate Has Been Approved by Area Manager";
  }

  if(jumlahApr == 2){
      if(bm == 1) {
        this.autoDisableBM1();
      }
      if(am == 1) {
        this.autoDisableBM1();
        this.autoDisableAM1();
      }
  }
  if(jumlahApr == 3){
    if(bm != 0) {
        this.autoDisableBM2();
      }
    if(am != 0) {
        this.autoDisableAM2();
        this.autoDisableBM2();
      }
    if(rh != 0){
        this.autoDisableBM2();
        this.autoDisableAM2();
        this.autoDisableRH2();
      }
  }
  if(jumlahApr == 4){
    if(bm != 0) {
        this.autoDisableBM3();
      }
    if(am != 0) {
        this.autoDisableAM3();
        this.autoDisableBM3();
      }
    if(rh != 0){
        this.autoDisableBM3();
        this.autoDisableAM3();
        this.autoDisableRH3();
      }
      if(dr != 0){
        this.autoDisableBM3();
        this.autoDisableAM3();
        this.autoDisableRH3();
        this.autoDisableDR3();
      }
  }
  
  
  

  
</script>
@endsection



