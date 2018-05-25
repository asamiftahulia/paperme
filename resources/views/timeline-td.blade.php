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
                        <h5 align="center">
                        @foreach($data as $datas)
                          <table align="center">
                            <tr>
                              <td>Name  : </td>
                              <td>{{$datas->full_name}} </td>
                            </tr>
                            <tr>
                              <td>Special Rate  : </td>
                              <td> {{$datas->special_rate}}</td>
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
                      <span class="time-wrapper"><span class="time">{{$datas->date_rollover}}</span></span>
                    </div>
                   @if($valButton == 1)
                    <div class="desc">Waiting An Action From Branch Manager<br>
                      <button type="button" data-toggle="modal" data-target="#modalDetailBM" class="btn btn-info btn-sm">Detail</button>
                      <button type="button" data-toggle="modal" data-target="#modalAprBM"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" data-toggle="modal" data-target="#modalRejBM"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                  </div>
                   @elseif($valButton == 0)
                    <div class="desc">Already Have An Action From Branch Manager<br>
                      <button type="button"  disabled="true" data-toggle="modal" data-target="#modalDetailBM" class="btn btn-info btn-sm">Detail</button>
                      <button type="button" disabled="true" data-toggle="modal" data-target="#modalAprBM"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" disabled="true" data-toggle="modal" data-target="#modalRejBM"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                  </div>
                   @endif
                </li>
                <!-- Revisi -->
                <div class="modal fade" id="modalDetailBM" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('td/revisi',$datas->id)}}" method="post">
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
                             <button type="button" class="btn btn-info">Cancel</button>
                             <button type="submit" class="btn btn-success">Approve</button>
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
                      <span class="time-wrapper"><span class="time">{{$datas->date_rollover}}</span></span>
                    </div>
                    @if($valButton == 1)
                    <div class="desc">Waiting An Action From Area Manager<br>
                      <button type="button" data-toggle="modal" data-target="#modalDetailAM"class="btn btn-info btn-sm">Detail</button>
                      <button type="button" data-toggle="modal" data-target="#modalAprAM"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" data-toggle="modal" data-target="#modalRejAM"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                    @elseif($valButton == 0)
                    <div class="desc">Already Have An Action From Area Manager<br>
                      <button type="button" disabled="true" data-toggle="modal" data-target="#modalDetailAM"class="btn btn-info btn-sm">Detail</button>
                      <button type="button" disabled="true" data-toggle="modal" data-target="#modalAprAM"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" disabled="true" data-toggle="modal" data-target="#modalRejAM"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                    @endif
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
                            <form action="{{url('td/revisi', $datas->id) }}" method="post">
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
                      <span class="time-wrapper"><span class="time">{{$datas->date_rollover}}</span></span>
                    </div>
                    @if($valButton == 1)
                    <div class="desc">Waiting An Action From Branch Manager<br>
                      <button type="button" data-toggle="modal" data-target="#modal2BMDet"class="btn btn-info btn-sm">Detail</button>
                      <button type="button" data-toggle="modal" data-target="#modal2BMApr"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" data-toggle="modal" data-target="#modal2BMRej"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                    @else if($valButton == 1)
                    <div class="desc">Already Have An Action From Branch Manager<br>
                      <button type="button" disabled = "true" data-toggle="modal" data-target="#modal2BMDet"class="btn btn-info btn-sm">Detail</button>
                      <button type="button" disabled = "true" data-toggle="modal" data-target="#modal2BMApr"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" disabled = "true" data-toggle="modal" data-target="#modal2BMRej"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                    @endif
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
                            <form action="{{url('td/revisi', $datas->id) }}" method="post">
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
                      <span class="time-wrapper"><span class="time">{{$datas->date_rollover}}</span></span>
                    </div>
                    @if($valButton == 1)
                    <div class="desc">Waiting An Action From Area Manager<br>
                      <button type="button" data-toggle="modal" data-target="#modal2AMDet"class="btn btn-info btn-sm">Detail</button>
                      <button type="button" data-toggle="modal" data-target="#modal2AMApr"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" data-toggle="modal" data-target="#modal2AMRej"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                    @else if($valButton == 0)
                    <div class="desc">Already Have An Action From Area Manager<br>
                      <button type="button" disabled = "true" data-toggle="modal" data-target="#modal2AMDet"class="btn btn-info btn-sm">Detail</button>
                      <button type="button" disabled = "true" data-toggle="modal" data-target="#modal2AMApr"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" disabled = "true" data-toggle="modal" data-target="#modal2AMRej"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                    @endif
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
                            <form action="{{url('td/revisi', $datas->id) }}" method="post">
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
                      <span class="time-wrapper"><span class="time">{{$datas->date_rollover}}</span></span>
                    </div>
                    @if($valButton == 1)
                    <div class="desc">Waiting An Action From Regional Head<br>
                      <button type="button" data-toggle="modal" data-target="#modal2RHDet"class="btn btn-info btn-sm">Detail</button>
                      <button type="button" data-toggle="modal" data-target="#modal2RHApr"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" data-toggle="modal" data-target="#modal2RHRej"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                    @else if($valButton == 0)
                    <div class="desc">Already Have An Action From Regional Head<br>
                      <button type="button" disabled="true" data-toggle="modal" data-target="#modal2RHDet"class="btn btn-info btn-sm">Detail</button>
                      <button type="button" disabled="true" data-toggle="modal" data-target="#modal2RHApr"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" disabled="true" data-toggle="modal" data-target="#modal2RHRej"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                    @endif 
                  </div>
                </li>
                <div class="modal fade" id="modal2RHDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('td/revisi', $datas->id) }}" method="post">
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
                      <span class="time-wrapper"><span class="time">{{$datas->date_rollover}}</span></span>
                    </div>
                    @if($valButton == 1)
                    <div class="desc">Waiting An Action From Area<br>
                      <button type="button" data-toggle="modal" data-target="#modal2BMDet"class="btn btn-info btn-sm">Detail</button>
                      <button type="button" data-toggle="modal" data-target="#modal2BMApr"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" data-toggle="modal" data-target="#modal2BMRej"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                    @else if($valButton == 0)
                    <div class="desc">Already Have An Action From Area<br>
                      <button type="button" disabled = "true" data-toggle="modal" data-target="#modal2BMDet"class="btn btn-info btn-sm">Detail</button>
                      <button type="button" disabled = "true" data-toggle="modal" data-target="#modal2BMApr"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" disabled = "true" data-toggle="modal" data-target="#modal2BMRej"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                    @endif
                  </div>
                </li>
                <div class="modal fade" id="modal2BMDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('td/revisi', $datas->id) }}" method="post">
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
                      <span class="time-wrapper"><span class="time">{{$datas->date_rollover}}</span></span>
                    </div>
                    @if($valButton == 1)
                    <div class="desc">Waiting An Action From Area Manager<br>
                      <button type="button" data-toggle="modal" data-target="#modal2AMDet"class="btn btn-info btn-sm">Detail</button>
                      <button type="button" data-toggle="modal" data-target="#modal2AMApr"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" data-toggle="modal" data-target="#modal2AMRej"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                    @elseif($valButton == 0)
                    <div class="desc">Already Have An Action From Area Manager<br>
                      <button type="button" disabled="true" data-toggle="modal" data-target="#modal2AMDet"class="btn btn-info btn-sm">Detail</button>
                      <button type="button" disabled="true" data-toggle="modal" data-target="#modal2AMApr"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" disabled="true" data-toggle="modal" data-target="#modal2AMRej"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                    @endif
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
                            <form action="{{url('td/revisi', $datas->id) }}" method="post">
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
                      <span class="time-wrapper"><span class="time">{{$datas->date_rollover}}</span></span>
                    </div>
                    @if($valButton == 1)
                    <div class="desc">Waiting An Action From Regional Head<br>
                      <button type="button" data-toggle="modal" data-target="#modal2RHDet"class="btn btn-info btn-sm">Detail</button>
                      <button type="button" data-toggle="modal" data-target="#modal2RHApr"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" data-toggle="modal" data-target="#modal2RHRej"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                    @elseif($valButton == 0)
                    <div class="desc">Already Have An Action From Regional Head<br>
                      <button type="button" disabled="true" data-toggle="modal" data-target="#modal2RHDet"class="btn btn-info btn-sm">Detail</button>
                      <button type="button" disabled="true" data-toggle="modal" data-target="#modal2RHApr"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" disabled="true" data-toggle="modal" data-target="#modal2RHRej"class="btn btn-danger btn-sm">Reject</button>
                    </div>
                    @endif
                  </div>
                </li>
                <div class="modal fade" id="modal2RHDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('td/revisi', $datas->id) }}" method="post">
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
                      <span class="time-wrapper"><span class="time">{{$datas->date_rollover}}</span></span>
                    </div>
                    @if($valButton == 1)
                    <div class="desc">Waiting An Action From Regional Head<br>
                      <button type="button" data-toggle="modal" data-target="#modal2DirDet" class="btn btn-sm btn-info">Detail</button>
                      <button type="button" data-toggle="modal" data-target="#modal2DirApr" class="btn btn-sm btn-success">Approve</button>
                      <button type="button" data-toggle="modal" data-target="#modal2DirRej" class="btn btn-sm btn-danger">Reject</button>
                    </div>
                    @elseif($valButton == 0)
                    <div class="desc">Already Have An Action From Regional Head<br>
                      <button type="button" disabled = "true" data-toggle="modal" data-target="#modal2DirDet" class="btn btn-sm btn-info">Detail</button>
                      <button type="button" disabled = "true" data-toggle="modal" data-target="#modal2DirApr" class="btn btn-sm btn-success">Approve</button>
                      <button type="button" disabled = "true" data-toggle="modal" data-target="#modal2DirRej" class="btn btn-sm btn-danger">Reject</button>
                    </div>
                    @endif
                  </div>
                </li>
                <div class="modal fade" id="modal2DirDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('td/revisi', $datas->id) }}" method="post">
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
                              <input type="hidden" enable="false" name="role" value="Director">
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
            </div>
          <a href="{{url('td/updateStatus',$datas->id)}}"><button type="button" class="btn btn-info">Finish</button></a>
        </div>
      </div>
    </div>
  </div>
@endsection


