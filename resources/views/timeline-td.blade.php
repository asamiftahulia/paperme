@extends('master-dp')
@section('page-title','Form Registrasi Time Deposit')
@section('content')
<div class="col-md-12">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h3>
                            Timeline Time Deposit Special Rate
                        </h3>
                        <h5>
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
                      <span class="time-wrapper"><span class="time">Januari 2019</span></span>
                    </div>
                    <div class="desc">Waiting An Action From Branch Manager<br>
                    <a href="">Detail</a>|<a href="">Revisi</a>|<a href="">Approve</a>|<a href="">Reject</a>
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
                    <a href="">Detail</a>|<a href="">Revisi</a>|<a href="">Approve</a>|<a href="">Reject</a></div>
                  </div>
                </li>
              @elseif($c == 2)
                <li>
                  <div class="direction-r">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Branch Manager</span>
                      <span class="time-wrapper"><span class="time">Januari 2019</span></span>
                    </div>
                    <div class="desc">Waiting An Action From Branch Manager<br>
                    <a href="">Detail</a>|<a href="">Revisi</a>|<a href="">Approve</a>|<a href="">Reject</a>
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
                    <a href="">Detail</a>|<a href="">Revisi</a>|<a href="">Approve</a>|<a href="">Reject</a></div>
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
                    <a href="">Detail</a>|<a href="">Revisi</a>|<a href="">Approve</a>|<a href="">Reject</a></div>
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
                    <a href="">Detail</a>|<a href="">Revisi</a>|<a href="">Approve</a>|<a href="">Reject</a>
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
                    <a href="">Detail</a>|<a href="">Revisi</a>|<a href="">Approve</a>|<a href="">Reject</a></div>
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
                    <a href="">Detail</a>|<a href="">Revisi</a>|<a href="">Approve</a>|<a href="">Reject</a></div>
                  </div>
                </li>
                  <li>
                  <div class="direction-l">
                    <div class="flag-wrapper">
                      <span class="hexa"></span>
                      <span class="flag">Direktur</span>
                      <span class="time-wrapper"><span class="time">Januari 2019</span></span>
                    </div>
                    <div class="desc">Waiting An Action From Director<br>
                    <a href="">Detail</a>|<a href="">Revisi</a>|<a href="">Approve</a>|<a href="">Reject</a></div>
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
