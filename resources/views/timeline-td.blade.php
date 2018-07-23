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
                  <h4 class="title">TIMELINE </br>
                  Time Deposit Special Rate
                  </h4>
                  <!-- <p class="category">Time Deposit Special Rate {{$valButton}}{{$trx}} </p>
                   -->
                  @foreach($data as $datas)
                  <p class="category"> created by {{$datas->created_by}} </br> created at {{date_format($datas->created_at,"d-m-Y")}} </p>
                  </div>
                    <div class="header">
                        </br></br>
                        <h5>
                        
                          <table>
                           
                            <tr>
                              <td>Name  </td>
                              <td> : </td>
                              <td> {{$datas->full_name}} </td>
                            </tr>
                            <tr>
                              <td>Amount</td>
                              <td> : </td>
                              <td> <?php echo number_format($datas->amount,2); ?> {{$datas->currency}}</td>
                            </tr>
                            <tr>
                              <td>Special Rate</td>
                              <td> : </td>
                              <td> {{$datas->special_rate}} %</td>
                            </tr>
                            <tr>
                              <td>Period</td>
                              <td> : </td>
                              <td> {{$datas->period}} Bulan</td>
                            </tr>
                            <tr>
                            <td>Image</td>
                              <td> : </td>
                              <td><a data-toggle="modal" data-target="#defaultModal">Bukti Sumber Dana</a></td>
                            </tr>
                            <!-- <tr>
                              <td>Jumlah Approver</td>
                              <td> : </td>
                              <td> {{$datas->approver}}</td>
                            </tr> -->
              <div class="row" align="right">
                <a align="center" href="{{route('td.index')}}"><input type="button" id="btn-submit" class="btn btn-warning" value="Back To List Time Deposit"></a>
                  <?php
                    if($checkApproved == $approver){ ?>
                      <a align="center" href="{{url('td/updateStatus',$datas->id)}}"><input type="button"  id="btn-finish"  class="btn btn-info" value="FINISH"></a>
                  <?php
                    }
                    ?>
            </div>
            </div>
                  <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" id="defaultModalLabel">Bukti Sumber Dana</h4>
                          </div>
                          <div class="modal-body">
                            {{csrf_field()}}
                            <img src="{{asset('/images/'.$datas->image)}}" />
                          </div>
                      </div>
                  </div>
                </div>
                            <!-- <tr>
                              <td>Sumber Dana bank</td>
                              <td>:</td>
                              <td>{{$datas->bank}}</td>  
                          </tr> -->
                            @php
                               $c = 0;
                                @endphp
                              @foreach($apr as $da)
                                @php $c = $c + 1;
                            @endphp
                          </table>
                            @endforeach

                            <!-- <table border=1>
                                <thead>td user{{session('username')}}
                                <tr>
                                    <th>bm</th>
                                    <th>am</th>
                                    <th>rh</th>
                                    <th>dir</th>
                                    <th>jum</th>
                                    <th>reg</th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                @foreach($user as $orang)
                                    <tr>
                                        <td>{{$orang->bm}}</td>
                                        <td>{{$orang->am}}</td>
                                        <td>{{$orang->rh}}</td>
                                        <td>{{$orang->dr}}</td>
                                        <td>{{$orang->jumlah}}</td>
                                        <td>{{$orang->region}}</td>
                                    </tr>
                                    
                                </tbody>
                            </table>  -->
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
                      </br>
                    </div>
                    <div class="desc"><p id="actionBM1">Waiting An Action From Branch Manager</p><br>
                    <span>{{$orang->bm}}</span></br>
                    <?php
                        if(session('username')==$orang->bm){
                    ?>
                      <input type="button" id="btn-revisi-bm1" data-toggle="modal" data-target="#modalDetailBM" class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id="btn-approve-bm1" value="Approve" data-toggle="modal" data-target="#modalAprBM"class="btn btn-success btn-sm"  >
                      <input type="button" id="btn-reject-bm1" data-toggle="modal" data-target="#modalRejBM"class="btn btn-danger btn-sm" value="Reject">
                    <?php
                        }
                    ?>
                    </div>
                  </div>
                </li>
                <!-- Revisi -->
                <div class="modal fade" id="modalDetailBM" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
                              <div class="modal-header">
                            </div>
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
                                  <input type="text" name="special_rate" id="special_rate" value="{{$datas->special_rate}}" size="10px" />
                                </td>
                                <input type="hidden" enable="false" name="role" value="Branch Manager">
                                <td>{{number_format($datas->amount)}}</td>
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
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                             <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                             <button type="submit" onclick="autoDisable();" class="btn btn-success">Approve</button>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modalRejBM" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak </b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Branch Manager">
                              <input type="hidden" enable="false" name="special_rate" value="{{$datas->special_rate}}">
                              <div align="right">
                             <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-danger">Reject</button>
                             </div>
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
                      <span class="time-wrapper"><span class="time" id="time-am-1">--</span></span>
                    </div>
                    <div class="desc"><p id="actionAM1">Waiting An Action From Area Manager</p><br>
                    
                      <span>{{$orang->am}}</span></br>
                      <?php
                      if(session('username')==$orang->am && $approverBM!=0){
                      ?>
                      <button type="button" id="btn-revisi-am1"data-toggle="modal" data-target="#modalDetailAM"class="btn btn-info btn-sm">Detail</button>
                      <button type="button" id="btn-approve-am1" data-toggle="modal" data-target="#modalAprAM"class="btn btn-success btn-sm">Approve</button>
                      <button type="button" id="btn-reject-am1" data-toggle="modal" data-target="#modalRejAM"class="btn btn-danger btn-sm">Reject</button>
                      <?php
                      }
                        ?>
                      
                    </div>
                    
                  </div>
                </li>
              <!-- </ul> -->
              <!-- Revisi -->
                <div class="modal fade" id="modalDetailAM" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                  <input type="text" name="special_rate" id="special_rate" value="{{$datas->special_rate}}" size="10" />
                                </td>
                                <td>{{number_format($datas->amount)}}</td>
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
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                              <div align="right">
                             <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-success">Approve</button>
                             </div>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="modal fade" id="modalRejAM" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('trx/reject',$datas->id)}}" method="post">
                              {{csrf_field()}}
                              <p>Apakah Benar Anda Akan <font color='red'><b>Menolak </b></font> Pengajuan Special Rate <br>
                                Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                                <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                                <input type="hidden" enable="false" name="role" value="Area Manager">
                                <input type="hidden"  name="special_rate" value="{{$datas->special_rate}}">
                              <div align="right">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Reject</button>
                              </div>
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
                    <span>{{$orang->bm}}</span></br>
                    <?php
                        if(session('username')==$orang->bm){
                    ?>
                      <input type="button" id="btn-revisi-bm2"  data-toggle="modal" data-target="#modal2BMDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id="btn-approve-bm2" data-toggle="modal" id="btn-approve-bm" data-target="#modal2BMApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" id="btn-reject-bm2" data-toggle="modal" data-target="#modal2BMRej"class="btn btn-danger btn-sm" value="Reject">
                    <?php
                        }else{ ?>
                          <input type="button" disabled="true" id="btn-revisi-bm2"  data-toggle="modal" data-target="#modal2BMDet"class="btn btn-info btn-sm" value="Detail">
                          <input type="button" disabled="true" id="btn-approve-bm2" data-toggle="modal" id="btn-approve-bm" data-target="#modal2BMApr"class="btn btn-success btn-sm" value="Approve">
                          <input type="button" disabled="true" id="btn-reject-bm2" data-toggle="modal" data-target="#modal2BMRej"class="btn btn-danger btn-sm" value="Reject">
                  
                    <?php
                      }  
                    ?>
                    </div>
                  </div>
                </li>
                <!-- Detail -->
                <div class="modal fade" id="modal2BMDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                  <input type="text" name="special_rate" id="special_rate" value="{{$datas->special_rate}}" size="10" />
                                </td>
                                <td>{{number_format($datas->amount)}}</td>
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
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                              <div align="right">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Approve</button>
                             </div>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modal2BMRej" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak </b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Branch Manager">
                              <input type="hidden"  name="special_rate" value="{{$datas->special_rate}}">
                              <div align="right">
                                  <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-danger">Reject</button>
                              </div>
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
                    <span>{{$orang->am}}</span></br>
                    <?php
                      if(session('username')==$orang->am && $approverBM!=0){
                    ?>
                      <input type="button" id ="btn-revisi-am2" data-toggle="modal" data-target="#modal2AMDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id ="btn-approve-am2" data-toggle="modal" data-target="#modal2AMApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" id ="btn-reject-am2" data-toggle="modal" data-target="#modal2AMRej"class="btn btn-danger btn-sm" value="Reject">
                    <?php
                      }else{
                        ?>
                      <input type="button" disabled="true" id ="btn-revisi-am2" data-toggle="modal" data-target="#modal2AMDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" disabled="true" id ="btn-approve-am2" data-toggle="modal" data-target="#modal2AMApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" disabled="true" id ="btn-reject-am2" data-toggle="modal" data-target="#modal2AMRej"class="btn btn-danger btn-sm" value="Reject">
                    <?php
                      }
                    ?>
                    </div>
                  </div>
                </li>
                <!-- Detail -->
                <div class="modal fade" id="modal2AMDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                <input type="text" name="special_rate" id="special_rate" value="{{$datas->special_rate}}" size="10" />
                                </td>
                                <td>{{number_format($datas->amount)}}</td>
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
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                              <div align="right">
                                  <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-success">Approve</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modal2AMRej" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak </b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Area Manager">
                              <input type="hidden"  name="special_rate" value="{{$datas->special_rate}}">
                              <div align="right">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Reject</button>
                              </div>
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
                    <span>{{$orang->rh}}</span></br>
                    <?php
                      if(session('username') == $orang->rh && $approverAM!=0){
                    ?>
                      <input type="button" id="btn-revisi-rh2" data-toggle="modal" data-target="#modal2RHDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id ="btn-approve-rh2" data-toggle="modal" data-target="#modal2RHApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" id ="btn-reject-rh2" data-toggle="modal" data-target="#modal2RHRej"class="btn btn-danger btn-sm" value="Reject">
                    <?php
                      }else{
                        ?>
                      <input type="button" disabled="true" id="btn-revisi-rh2" data-toggle="modal" data-target="#modal2RHDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" disabled="true" id ="btn-approve-rh2" data-toggle="modal" data-target="#modal2RHApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" disabled="true" id ="btn-reject-rh2" data-toggle="modal" data-target="#modal2RHRej"class="btn btn-danger btn-sm" value="Reject">
                        <?php
                      }
                      ?>
                    </div>
                  </div>
                </li>
                <div class="modal fade" id="modal2RHDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                <input type="text" name="special_rate" id="special_rate" value="{{$datas->special_rate}}" size="3" />
                                </td>
                                <td>{{number_format($datas->amount)}}</td>
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
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                              <div align="right">
                                  <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-success">Approve</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modal2RHRej" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak </b></font>Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Regional Head">
                              <input type="hidden"  name="special_rate" value="{{$datas->special_rate}}">
                              <div align="right">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Reject</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
              <!-- </ul> -->
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
                    <div class="desc"><p id="act-bm3">Waiting An Action From Branch Manager<br></p>
                    <span>{{$orang->bm}}</span></br>
                    <?php
                        if(session('username')==$orang->bm){
                    ?>
                      <input type="button" id="btn-revisi-bm3" data-toggle="modal" data-target="#modal2BMDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id="btn-approve-bm3"data-toggle="modal" id="btn-approve-bm" data-target="#modal2BMApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" id="btn-reject-bm3"data-toggle="modal" data-target="#modal2BMRej"class="btn btn-danger btn-sm" value="Reject">
                    <?php
                        }?>
                    </div>
                  </div>
                </li>
                <div class="modal fade" id="modal2BMDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                <td>{{number_format($datas->amount)}}</td>
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
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                            <div align="right">
                             <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-success">Approve</button>
                             </div>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modal2BMRej" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                           {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak </b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}}</b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Branch Manager">
                              <input type="hidden"  name="special_rate" value="{{$datas->special_rate}}">
                              <div align="right">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Reject</button>
                             </div>
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
                    <span>{{$orang->am}}</span></br>
                    <?php
                        if(session('username')==$orang->am && $approverBM!=0){
                    ?>
                      <input type="button" id="btn-revisi-am3" data-toggle="modal" data-target="#modal2AMDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id="btn-approve-am3" data-toggle="modal" data-target="#modal2AMApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" id="btn-reject-am3" data-toggle="modal" data-target="#modal2AMRej"class="btn btn-danger btn-sm" value="Reject">
                    <?php
                        }?>
                    </div>
                  </div>
                </li>
                <!-- Detail -->
                <div class="modal fade" id="modal2AMDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                  <input type="text" name="special_rate" id="special_rate" value="{{$datas->special_rate}}" size="10" />
                                </td>
                                <td>{{number_format($datas->amount)}}</td>
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
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                              <div align="right">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Approve</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modal2AMRej" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                           {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak </b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Area Manager">
                              <input type="hidden"  name="special_rate" value="{{$datas->special_rate}}">
                              <div align="right">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Reject</button>
                              </div>
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
                    <span>{{$orang->rh}}</span></br>
                    <?php
                        if(session('username')==$orang->rh && $approverAM!=0){
                    ?>
                      <input type="button" id="btn-revisi-rh3" data-toggle="modal" data-target="#modal2RHDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id="btn-approve-rh3" data-toggle="modal" data-target="#modal2RHApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" id="btn-reject-rh3" data-toggle="modal" data-target="#modal2RHRej"class="btn btn-danger btn-sm" value="Reject">
                    <?php
                        }?>
                    </div>
                  </div>
                </li>
                <div class="modal fade" id="modal2RHDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                              </tr>
                              <tr>
                                <td><input type="text" name="" value="{{$datas->full_name}}" class="form-control" disabled></td>
                                <td>
                                <input type="hidden" name="role" value="Regional Head"/>
                                <input type="text" name="special_rate" id="special_rate" value="{{$datas->special_rate}}" size="3" />
                                </td>
                                <td>{{number_format($datas->amount)}}</td>
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
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                              <div align="right">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Approve</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modal2RHRej" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                           {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak </b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                             <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                             <input type="hidden" enable="false" name="role" value="Regional Head">
                             <input type="hidden"  name="special_rate" value="{{$datas->special_rate}}">
                             <div align="right">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Reject</button>
                              </div>
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
                    <div class="desc"><p id="act-dr3">Waiting An Action From Director<br></p>
                    <span>{{$orang->dr}}</span></br>
                    <?php
                      if(session('username') == $orang->dr && $approverRH!=0){
                    ?>
                      <input type="button" id="btn-revisi-dr3" data-toggle="modal" data-target="#modal2DirDet" class="btn btn-sm btn-info" value="Detail">
                      <input type="button" id="btn-approve-dr3" data-toggle="modal" data-target="#modal2DirApr" class="btn btn-sm btn-success" value="Approve">
                      <input type="button" id="btn-reject-dr3" data-toggle="modal" data-target="#modal2DirRej" class="btn btn-sm btn-danger" value="Reject">
                    <?php
                    }?>

                    </div>
                  </div>
                </li>
                <div class="modal fade" id="modal2DirDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                  <input type="text" name="special_rate" id="special_rate" value="{{$datas->special_rate}}" size="3" />
                                  
                                </td>
                                <td>{{number_format($datas->amount)}}</td>
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
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                              <div align="right">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Approve</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modal2DirRej" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak </b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}}</b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Director">
                              <input type="hidden"  name="special_rate" value="{{$datas->special_rate}}">
                              <div align="right">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Reject</button>
                              <div align="right">
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
              <!-- </ul> -->
              @endif
              
              <?php
              $tmp = $c + 1;
                if($tmp < $datas->approver){ 
                  if($datas->approver == 3){ ?>
                <li>
                  <div class="direction-r">
                    <div class="flag-wrapper">
                    @foreach($rev as $key => $data) 
                      <span class="hexa"></span>
                      <span class="flag">Regional Head</span>
                      <span class="time-wrapper"><span class="time">{{date('d-m-Y', strtotime($data->created_at))}}</span></span>
                    </div>
                    @endforeach
                   
                    <?php
                        if((session('username')==$orang->rh || session('username')==$orang->am || session('username')==$orang->bm)&& $approverAM!= 0 && $revisiRH != 0 && $tandaRevisiMenghilangkan != 0){
                    ?>
                     <div class="desc"><p id="act-revisi-rh3-telah"><font color='orange'>Telah Merevisi Special Rate Menjadi {{$data->special_rate}} % </br> </font>
                     <p><input type="button" id="btnrev-revisi-rh3"  data-toggle="modal" data-target="#modal2RHDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id="btnrev-approve-rh3"  data-toggle="modal" data-target="#modal2RHApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" id="btnrev-reject-rh3"   data-toggle="modal" data-target="#modal2RHRej"class="btn btn-danger btn-sm" value="Reject"></p>
                    
                    <?php
                        if($approverRH!=0)
                        {
                        ?> <div class="desc"><p id="act-revisi-rh3-apr">This Special Rate Has Been <font color='Green'>Approved</font>  by Regional Head</br>
                        <p><span>{{$orang->rh}}</span></br></p>
                      <p><input type="button" id="btnrev-revisi-rh3" disabled="true" data-toggle="modal" data-target="#modal2RHDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id="btnrev-approve-rh3"  disabled="true" data-toggle="modal" data-target="#modal2RHApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" id="btnrev-reject-rh3"  disabled="true" data-toggle="modal" data-target="#modal2RHRej"class="btn btn-danger btn-sm" value="Reject"></p>
                    <?php
                        }else if($rejectRH!=0){ 
                    ?>
                          <div class="desc"><p id="act-revisi-rh3-apr">This Special Rate Has Been <font color='red'>Rejected</font>  by Regional Head</br>
                          
                    <?php
                        }
                        ?>
                    
                    <?php
                        }else{
                          ?>
                      <div class="desc"><p id="act-revisi-rh3-telah"><font color='orange'>Telah Merevisi Special Rate Menjadi {{$data->special_rate}} % </br> </font>
                      <div class="desc"><p id="act-revisi-rh3"></br> 
                      <p><span>{{$orang->rh}}</span></br></p>
                      <input type="button" disabled="true" id="btnrev-revisi-rh3" data-toggle="modal" data-target="#modal2RHDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" disabled="true" id="btnrev-approve-rh3" data-toggle="modal" data-target="#modal2RHApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" disabled="true" id="btnrev-reject-rh3" data-toggle="modal" data-target="#modal2RHRej"class="btn btn-danger btn-sm" value="Reject">
                          <?php
                        }
                        ?>
                    </div>
                  </div>
                </li>
              <?php 
               }else if($datas->approver == 4){ ?>
<li>
                  <div class="direction-r">
                    <div class="flag-wrapper">
                    @foreach($rev as $key => $data) 
                      <span class="hexa"></span>
                      <span class="flag">Regional Head</span>
                      <span class="time-wrapper"><span class="time">{{date('d-m-Y', strtotime($data->created_at))}}</span></span>
                    </div>
                    @endforeach
                   
                    <?php
                        if(session('username')=='setiawati.samahita@idn.ccb.com' && $approverRH!= 0 && $revisiDR != 0 && $tandaRevisiMenghilangkan != 0){
                    ?>
                     <!-- <div class="desc"><p id="act-revisi-rh3-telah"><font color='orange'>Telah Merevisi Special Rate Menjadi {{$data->special_rate}} % </br> </font> -->
                    <?php
                        if($approverRH!=0)
                        {
                        ?> <div class="desc"><p id="act-revisi-rh3-apr">This Special Rate Has Been <font color='Green'>Approved</font>  by Regional Head</br>
                        <p><span>{{$orang->rh}}</span></br></p>
                      <p><input type="button" id="btnrev-revisi-rh3" disabled="true" data-toggle="modal" data-target="#modal2RHDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id="btnrev-approve-rh3"  disabled="true" data-toggle="modal" data-target="#modal2RHApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" id="btnrev-reject-rh3"  disabled="true" data-toggle="modal" data-target="#modal2RHRej"class="btn btn-danger btn-sm" value="Reject"></p>
                    <?php
                        }else if($rejectRH!=0){ 
                    ?>
                          <div class="desc"><p id="act-revisi-rh3-apr">This Special Rate Has Been <font color='red'>Rejected</font>  by Regional Head</br>
                          
                    <?php
                        }
                        ?>
                    
                    <?php
                        }else{
                          ?>
                      <div class="desc"><p id="act-revisi-rh3-telah"><font color='orange'>Telah Merevisi Special Rate Menjadi {{$data->special_rate}} % </br> </font>
                      <div class="desc"><p id="act-revisi-rh3"></br> 
                      <p><span>{{$orang->rh}}</span></br></p>
                      <input type="button" disabled="true" id="btnrev-revisi-rh3" data-toggle="modal" data-target="#modal2RHDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" disabled="true" id="btnrev-approve-rh3" data-toggle="modal" data-target="#modal2RHApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" disabled="true" id="btnrev-reject-rh3" data-toggle="modal" data-target="#modal2RHRej"class="btn btn-danger btn-sm" value="Reject">
                          <?php
                        }
                        ?>
                    </div>
                  </div>
                </li>
                <!-- Director -->
                <li>
                  <div class="direction-l">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Director</span>
                      <span class="time-wrapper"><span class="time" id="approved-date-by-dr33">-</span></span>
                    </div>
                    <?php
                      if(session('username') == $orang->dr && $approverRH!=0 && $tandaRevisiMenghilangkan != 0){   ?>
                      <div class="desc"><p id="act-dr33"><font color='orange'>Telah Merevisi Special Rate Menjadi {{$data->special_rate}} % </br> </font>
                      <!-- <span>Director : {{$orang->dr}}</span></br> -->
                      <?php
                        if($approverDR!=0)
                        {
                        ?> <div class="desc"><p id="act-revisi-rh3-apr">This Special Rate Has Been <font color='Green'>Approved</font>  by Director</br>
                        <p><span>{{$orang->dr}}</span></br></p>
                      <p>
                      <input type="button" id="btnrev-revisi-rh3" disabled="true" data-toggle="modal" data-target="#modal2RHDet"class="btn btn-info btn-sm" value="Detail">
                      <input type="button" id="btnrev-approve-rh3"  disabled="true" data-toggle="modal" data-target="#modal2RHApr"class="btn btn-success btn-sm" value="Approve">
                      <input type="button" id="btnrev-reject-rh3"  disabled="true" data-toggle="modal" data-target="#modal2RHRej"class="btn btn-danger btn-sm" value="Reject">
                    <?php
                        }else if($rejectDR!=0){ 
                    ?>
                          <div class="desc"><p id="act-revisi-rh3-apr">This Special Rate Has Been <font color='red'>Rejected</font>  by Director</br>
                          
                    <?php
                        }
                        ?>
                      <?php
                    }else{?>
                      <input type="button" disabled="true" id="btn-revisi-dr3" data-toggle="modal" data-target="#modal2DirDet" class="btn btn-sm btn-info" value="Detail">
                      <input type="button" disabled="true" id="btn-approve-dr3" data-toggle="modal" data-target="#modal2DirApr" class="btn btn-sm btn-success" value="Approve">
                      <input type="button" disabled="true" id="btn-reject-dr3" data-toggle="modal" data-target="#modal2DirRej" class="btn btn-sm btn-danger" value="Reject">
                    <?php
                      }
                    ?>

                    </div>
                  </div>
                </li>
        <?php    }
              }
              ?>
             @endforeach
             <!-- REGIONAL -->
             <div class="modal fade" id="modal2RHDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                              <div align="right">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Approve</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modal2RHRej" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak </b></font>Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}} </b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Regional Head">
                              <input type="hidden"  name="special_rate" value="{{$datas->special_rate}}">
                              <div align="right">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Reject</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
            </br></br></br></br></br>
            <!-- director -->
            <div class="modal fade" id="modal2DirDet" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                              <div align="right">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Approve</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- Reject -->
                <div class="modal fade" id="modal2DirRej" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
                          </div>
                          <div class="modal-body">
                           <form action="{{url('trx/reject',$datas->id)}}" method="post">
                            {{csrf_field()}}
                            <p>Apakah Benar Anda Akan <font color='red'><b>Menolak </b></font> Pengajuan Special Rate <br>
                              Atas Nama <b> {{$datas->full_name}}</b> ? </p>
                              <input type="hidden" enable="false" name="id_td" value="{{$datas->id}}">
                              <input type="hidden" enable="false" name="role" value="Director">
                              <input type="hidden"  name="special_rate" value="{{$datas->special_rate}}">
                              <div align="right">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Reject</button>
                              <div align="right">
                          </form>
                          </div>
                      </div>
                  </div>
                </div>
            @endforeach
          
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

today = dd + '-' + mm + '-' + yyyy;

var jumlahApr = '<?php echo $jumlahApr; ?>';
var approver = '<?php echo $valButton; ?>'
var period = '<?php echo $period; ?>'
var bm = '<?php echo $approverBM; ?>'
var am = '<?php echo $approverAM; ?>'
var rh = '<?php echo $approverRH;?>'
var dr = '<?php echo $approverDR;?>'

var rejectbm = '<?php echo $rejectBM; ?>'
var rejectam = '<?php echo $rejectAM; ?>'
var rejectrh = '<?php echo $rejectRH;?>'
var rejectdr = '<?php echo $rejectDR;?>'

var tandaRevisiMenghilangkan = '<?php echo $tandaRevisiMenghilangkan; ?>'
var revisirh = '<?php echo $revisiRH;?>'
var revisidr = '<?php echo $revisiDR;?>'

console.log('Jumlah Approver: ', jumlahApr);
console.log('Period: ', period);
console.log('approverBM: ', bm);
console.log('approverAM: ', am);
console.log('approverRH: ', rh);
console.log('approverDR: ', dr);
console.log('-----------------');
console.log('rejectBM: ', rejectbm);
console.log('rejectAM: ', rejectam);
console.log('rejectRH: ', rejectrh);
console.log('rejectrDR: ', rejectdr);
console.log('------------------');
console.log('revisiRH:', revisirh);
console.log('revisiDR:', revisidr);
console.log('tandaRevisiMenghilangkan:', tandaRevisiMenghilangkan);


$("input").click(function(e){
    var idClicked = e.target.id;
    console.log('idclicked:', idClicked);
});

  function autoDisableBM1() {   
    if(rejectbm == 0)
      document.getElementById("actionBM1").innerHTML = "This Special Rate Has Been <font color='Green'>Approved</font>  by Branch Manager";
    else
    document.getElementById("actionBM1").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Branch Manager";
    document.getElementById('btn-approve-bm1').style.visibility = 'hidden';
    document.getElementById("btn-revisi-bm1").style.visibility = 'hidden';
    document.getElementById("btn-reject-bm1").style.visibility = 'hidden';
    document.getElementById("time").innerHTML = today;
  }

  function autoDisableAM1() {
    document.getElementById("time-am-1").innerHTML = today;
    document.getElementById('actionAM1').innerHTML = "This Special Rate Has Been <font color='green'>Approved </font>by Area Manager";
    document.getElementById('btn-approve-am1').style.visibility = 'hidden';
    document.getElementById("btn-revisi-am1").style.visibility = 'hidden';
    document.getElementById("btn-reject-am1").style.visibility = 'hidden';
  }

  // 3 approver 
   function autoDisableBM2() {
    document.getElementById("btn-approve-bm2").style.visibility = 'hidden';
    document.getElementById("btn-revisi-bm2").style.visibility = 'hidden';
    document.getElementById("btn-reject-bm2").style.visibility = 'hidden';
    document.getElementById("approved-date-by-bm2").innerHTML = today;
    if(rejectbm == 0)
      document.getElementById("act-bm2").innerHTML = "This Special Rate Has Been <font color='green'>Approved</font> by Branch Manager";
    else
    document.getElementById("act-bm2").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Branch Manager";
  }

  function autoDisableAM2() {
    document.getElementById("btn-approve-am2").style.visibility = 'hidden';
    document.getElementById("btn-revisi-am2").style.visibility = 'hidden';
    document.getElementById("btn-reject-am2").style.visibility = 'hidden';
    document.getElementById("approved-date-by-am2").innerHTML = today;
    if(rejectam == 0)
      document.getElementById("act-am2").innerHTML = "This Special Rate Has Been <font color='green'>Approved</font> by Area Manager";
    else
    document.getElementById("act-am2").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Area Manager";
  }

   function autoDisableRH2() {
    document.getElementById("btn-approve-rh2").style.visibility = 'hidden';
    document.getElementById("btn-revisi-rh2").style.visibility = 'hidden';
    document.getElementById("btn-reject-rh2").style.visibility = 'hidden';
    document.getElementById("approved-date-by-rh2").innerHTML = today;
    if(rejectrh == 0)
      document.getElementById("act-rh2").innerHTML = "This Special Rate Has Been <font color='green'>Approved</font> by Regional Head";
    else
      document.getElementById("act-rh2").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Regional Head";
  }

  // approver 4

   function autoDisableBM3() {
    document.getElementById("btn-approve-bm3").style.visibility = 'hidden';
    document.getElementById("btn-revisi-bm3").style.visibility = 'hidden';
    document.getElementById("btn-reject-bm3").style.visibility = 'hidden';
    document.getElementById("approved-date-by-bm3").innerHTML = today;
    if(rejectbm == 0)
      document.getElementById("act-bm3").innerHTML = "This Special Rate Has Been <font color='green'>Approved</font> by Branch Manager";
    else
      document.getElementById("act-bm3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Branch Manager";
  }

  function autoDisableAM3() {
    document.getElementById("btn-approve-am3").style.visibility = 'hidden';
    document.getElementById("btn-revisi-am3").style.visibility = 'hidden';
    document.getElementById("btn-reject-am3").style.visibility = 'hidden';
    document.getElementById("approved-date-by-am3").innerHTML = today;
    if(rejectam == 0)
      document.getElementById("act-am3").innerHTML = "This Special Rate Has Been <font color='green'>Approved</font> by Area Manager";
    else
      document.getElementById("act-am3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Area Manager";
  }

   function autoDisableRH3() {
    document.getElementById("btn-approve-rh3").style.visibility = 'hidden';
    document.getElementById("btn-revisi-rh3").style.visibility = 'hidden';
    document.getElementById("btn-reject-rh3").style.visibility = 'hidden';
    document.getElementById("approved-date-by-rh3").innerHTML = today;
    if(rejectrh == 0)
      document.getElementById("act-rh3").innerHTML = "This Special Rate Has Been <font color='green'>Approved</font> by Regional Head";
    else
      document.getElementById("act-rh3").innerHTML = "This Special Rate Has Been <font color='red'> Rejected</font>by Regional Head";
  }

   function autoDisableDR3() {
    if(rejectdr == 0)
      document.getElementById("act-dr3").innerHTML = "This Special Rate Has Been <font color='green'>Approved</font> by Director";
    else
      document.getElementById("act-dr3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Director";

    document.getElementById("approved-date-by-dr3").innerHTML = today;
    document.getElementById("btn-approve-dr3").style.visibility = 'hidden';
    document.getElementById("btn-revisi-dr3").style.visibility = 'hidden';
    document.getElementById("btn-reject-dr3").style.visibility = 'hidden';
    document.getElementById("btn-finish").disabled = false;
    
   }

  if(jumlahApr == 2){
    if(am != 0){
      this.autoDisableAM1();
    }
    if(bm != 0){
      this.autoDisableBM1();
    
    }
  }else if(jumlahApr==3){
    if(bm != 0){
       this.autoDisableBM2();
    }
    if(am != 0){
      this.autoDisableBM2();
      this.autoDisableAM2();
    }
    if(rh != 0){
      this.autoDisableRH2();
    }else if(rh != 00 && revisirh!=0){
      document.getElementById("act-revisi-rh3-br").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Branch Manager";
    }
    // REJECT
    if(rejectbm == 1){
        document.getElementById("approved-date-by-bm2").innerHTML = today;
        document.getElementById("approved-date-by-am2").innerHTML = today;
        document.getElementById("approved-date-by-rh2").innerHTML = today;

        document.getElementById("btn-approve-bm2").disabled = true;
        document.getElementById("btn-revisi-bm2").disabled = true;
        document.getElementById("btn-reject-bm2").disabled = true;

        document.getElementById("btn-approve-am2").disabled = true;
        document.getElementById("btn-revisi-am2").disabled = true;
        document.getElementById("btn-reject-am2").disabled = true;

        document.getElementById("btn-approve-rh2").disabled = true;
        document.getElementById("btn-revisi-rh2").disabled = true;
        document.getElementById("btn-reject-rh2").disabled = true;


        document.getElementById("act-bm2").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Branch Manager";
        document.getElementById("act-am2").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Branch Manager";
        document.getElementById("act-rh2").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Branch Manager";
        
      }
      if(rejectam != 0){
        document.getElementById("approved-date-by-am2").innerHTML = today;
        document.getElementById("approved-date-by-rh2").innerHTML = today;
        document.getElementById("btn-approve-am2").disabled = true;
        document.getElementById("btn-revisi-am2").disabled = true;
        document.getElementById("btn-reject-am2").disabled = true;
        
        document.getElementById("act-bm2").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Area Manager";
        document.getElementById("act-am2").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Area Manager";
        document.getElementById("act-rh2").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Area Manager";
        document.getElementById("act-dr2").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Area Manager";
      }
    if(rejectrh != 0){
        document.getElementById("approved-date-by-rh2").innerHTML = today;
        document.getElementById("btn-approve-bm2").disabled = true;
        document.getElementById("btn-revisi-bm2").disabled = true;
        document.getElementById("btn-reject-bm2").disabled = true;

        document.getElementById("btn-approve-am2").disabled = true;
        document.getElementById("btn-revisi-am2").disabled = true;
        document.getElementById("btn-reject-am2").disabled = true;

        document.getElementById("btn-approve-rh2").disabled = true;
        document.getElementById("btn-revisi-rh2").disabled = true;
        document.getElementById("btn-reject-rh2").disabled = true;

        document.getElementById("act-bm2").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Regional Head";
        document.getElementById("act-am2").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Regional Head";
        document.getElementById("act-rh2").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Regional Head";
        document.getElementById("act-dr2").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Regional Head";
      }
      
      // REVISI
      
  }else{
    if(bm != 0){
       this.autoDisableBM3();
    }
    if(am != 0){
      this.autoDisableAM3();
    }
    if(rh != 0){
      this.autoDisableRH3();
    }
    if(dr != 0){
      this.autoDisableDR3();
    }
    // REJECT
       if(rejectbm == 1){
        document.getElementById("approved-date-by-bm3").innerHTML = today;
        document.getElementById("approved-date-by-am3").innerHTML = today;
        document.getElementById("approved-date-by-rh3").innerHTML = today;
        document.getElementById("approved-date-by-dr3").innerHTML = today;

        document.getElementById("btn-approve-bm3").disabled = true;
        document.getElementById("btn-revisi-bm3").disabled = true;
        document.getElementById("btn-reject-bm3").disabled = true;

        document.getElementById("btn-approve-am3").disabled = true;
        document.getElementById("btn-revisi-am3").disabled = true;
        document.getElementById("btn-reject-am3").disabled = true;

        document.getElementById("btn-approve-rh3").disabled = true;
        document.getElementById("btn-revisi-rh3").disabled = true;
        document.getElementById("btn-reject-rh3").disabled = true;

        document.getElementById("btn-approve-dr3").disabled = true;
        document.getElementById("btn-revisi-dr3").disabled = true;
        document.getElementById("btn-reject-dr3").disabled = true;

        document.getElementById("act-bm3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Branch Manager";
        document.getElementById("act-am3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Branch Manager";
        document.getElementById("act-rh3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Branch Manager";
        document.getElementById("act-dr3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Branch Manager";
      }
      if(rejectam == 1){
        document.getElementById("approved-date-by-bm3").innerHTML = today;
        document.getElementById("approved-date-by-am3").innerHTML = today;
        document.getElementById("approved-date-by-rh3").innerHTML = today;
        document.getElementById("approved-date-by-dr3").innerHTML = today;

        document.getElementById("btn-approve-bm3").disabled = true;
        document.getElementById("btn-revisi-bm3").disabled = true;
        document.getElementById("btn-reject-bm3").disabled = true;

        document.getElementById("btn-approve-am3").disabled = true;
        document.getElementById("btn-revisi-am3").disabled = true;
        document.getElementById("btn-reject-am3").disabled = true;

        document.getElementById("btn-approve-rh3").disabled = true;
        document.getElementById("btn-revisi-rh3").disabled = true;
        document.getElementById("btn-reject-rh3").disabled = true;

        document.getElementById("btn-approve-dr3").disabled = true;
        document.getElementById("btn-revisi-dr3").disabled = true;
        document.getElementById("btn-reject-dr3").disabled = true;

        document.getElementById("act-bm3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Area Manager";
        document.getElementById("act-am3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Area Manager";
        document.getElementById("act-rh3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Area Manager";
        document.getElementById("act-dr3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Area Manager";
      }

         if(rejectrh == 1){
        document.getElementById("btn-approve-bm3").disabled = true;
        document.getElementById("btn-revisi-bm3").disabled = true;
        document.getElementById("btn-reject-bm3").disabled = true;

        document.getElementById("btn-approve-am3").disabled = true;
        document.getElementById("btn-revisi-am3").disabled = true;
        document.getElementById("btn-reject-am3").disabled = true;

        document.getElementById("btn-approve-rh3").disabled = true;
        document.getElementById("btn-revisi-rh3").disabled = true;
        document.getElementById("btn-reject-rh3").disabled = true;

        document.getElementById("btn-approve-dr3").disabled = true;
        document.getElementById("btn-revisi-dr3").disabled = true;
        document.getElementById("btn-reject-dr3").disabled = true;

        document.getElementById("act-bm3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Regional Head";
        document.getElementById("act-am3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Regional Head";
        document.getElementById("act-rh3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Regional Head";
        document.getElementById("act-dr3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Regional Head";
      }
    if(rejectdr == 1){
        document.getElementById("approved-date-by-dr3").innerHTML = today;
        document.getElementById("btn-approve-bm3").disabled = true;
        document.getElementById("btn-revisi-bm3").disabled = true;
        document.getElementById("btn-reject-bm3").disabled = true;

        document.getElementById("btn-approve-am3").disabled = true;
        document.getElementById("btn-revisi-am3").disabled = true;
        document.getElementById("btn-reject-am3").disabled = true;

        document.getElementById("btn-approve-rh3").disabled = true;
        document.getElementById("btn-revisi-rh3").disabled = true;
        document.getElementById("btn-reject-rh3").disabled = true;

        document.getElementById("btn-approve-dr3").disabled = true;
        document.getElementById("btn-revisi-dr3").disabled = true;
        document.getElementById("btn-reject-dr3").disabled = true;

        document.getElementById("act-bm3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Director";
        document.getElementById("act-am3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Director";
        document.getElementById("act-rh3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Director";
        document.getElementById("act-dr3").innerHTML = "This Special Rate Has Been <font color='red'>Rejected</font> by Director";
        }
  }
</script>
@endsection



