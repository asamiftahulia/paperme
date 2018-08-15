@extends('master-dp')
@section('page-title','Time Deposit Special Rate')
@section('content')
<style type="text/css">
    /* Nav Tabs ==================================== */
.nav-tabs {
  border-bottom: 2px solid #eee; }
  .nav-tabs > li {
    position: relative;
    top: 3px;
    left: -2px; }
    .nav-tabs > li > a {
      border: none !important;
      color: #999 !important;
      -webkit-border-radius: 0;
      -moz-border-radius: 0;
      -ms-border-radius: 0;
      border-radius: 0; }
      .nav-tabs > li > a:hover, .nav-tabs > li > a:active, .nav-tabs > li > a:focus {
        background-color: transparent !important; }
      .nav-tabs > li > a:before {
        content: '';
        position: absolute;
        left: 0;
        width: 100%;
        height: 0;
        border-bottom: 2px solid #2196F3;
        bottom: 2px;
        -moz-transform: scaleX(0);
        -ms-transform: scaleX(0);
        -o-transform: scaleX(0);
        -webkit-transform: scaleX(0);
        transform: scaleX(0);
        -moz-transition: 0.1s ease-in;
        -o-transition: 0.1s ease-in;
        -webkit-transition: 0.1s ease-in;
        transition: 0.1s ease-in; }
      .nav-tabs > li > a .material-icons {
        position: relative;
        top: 7px;
        margin-bottom: 8px; }
  .nav-tabs li.active a {
    color: #222 !important; }
    .nav-tabs li.active a:hover, .nav-tabs li.active a:active, .nav-tabs li.active a:focus {
      background-color: transparent !important; }
    .nav-tabs li.active a:before {
      -moz-transform: scaleX(1);
      -ms-transform: scaleX(1);
      -o-transform: scaleX(1);
      -webkit-transform: scaleX(1);
      transform: scaleX(1); }
  .nav-tabs + .tab-content {
    padding: 15px 0; }

.nav-tabs.tab-col-red > li > a:before {
  border-bottom: 2px solid #F44336; }

.nav-tabs.tab-col-pink > li > a:before {
  border-bottom: 2px solid #E91E63; }

.nav-tabs.tab-col-purple > li > a:before {
  border-bottom: 2px solid #9C27B0; }

.nav-tabs.tab-col-deep-purple > li > a:before {
  border-bottom: 2px solid #673AB7; }

.nav-tabs.tab-col-indigo > li > a:before {
  border-bottom: 2px solid #3F51B5; }

.nav-tabs.tab-col-blue > li > a:before {
  border-bottom: 2px solid #2196F3; }

.nav-tabs.tab-col-light-blue > li > a:before {
  border-bottom: 2px solid #03A9F4; }

.nav-tabs.tab-col-cyan > li > a:before {
  border-bottom: 2px solid #00BCD4; }

.nav-tabs.tab-col-teal > li > a:before {
  border-bottom: 2px solid #009688; }

.nav-tabs.tab-col-green > li > a:before {
  border-bottom: 2px solid #4CAF50; }

.nav-tabs.tab-col-light-green > li > a:before {
  border-bottom: 2px solid #8BC34A; }

.nav-tabs.tab-col-lime > li > a:before {
  border-bottom: 2px solid #CDDC39; }

.nav-tabs.tab-col-yellow > li > a:before {
  border-bottom: 2px solid #ffe821; }

.nav-tabs.tab-col-amber > li > a:before {
  border-bottom: 2px solid #FFC107; }

.nav-tabs.tab-col-orange > li > a:before {
  border-bottom: 2px solid #FF9800; }

.nav-tabs.tab-col-deep-orange > li > a:before {
  border-bottom: 2px solid #FF5722; }

.nav-tabs.tab-col-brown > li > a:before {
  border-bottom: 2px solid #795548; }

.nav-tabs.tab-col-grey > li > a:before {
  border-bottom: 2px solid #9E9E9E; }

.nav-tabs.tab-col-blue-grey > li > a:before {
  border-bottom: 2px solid #607D8B; }

.nav-tabs.tab-col-black > li > a:before {
  border-bottom: 2px solid #000000; }

.nav-tabs.tab-col-white > li > a:before {
  border-bottom: 2px solid #ffffff; }
</style>
<!-- Example Tab -->
<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#home" data-toggle="tab">HOME</a></li>
                                <li role="presentation"><a href="#profile" data-toggle="tab">PROFILE</a></li>
                                <li role="presentation"><a href="#messages" data-toggle="tab">MESSAGES</a></li>
                                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home">
                                    <b>Single Data</b>
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <th>No</th>
                                            <th>Full Name</th>
                                            <th>Amount</th>
                                            <th>Special Rate</th>
                                            <th>Period</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                          <?php $no = 0; ?>
                                          @foreach($lengkapForBMSingle as $data)
                                          <?php $no = $no+1; ?>
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$data->full_name}}</td>
                                                <td>{{$data->amount}}</td>
                                                <td>{{$data->special_rate}}</td>
                                                <td>{{$data->period}}</td>
                                                <td>{{$data->status}}</td>
                                                <td>
                                                    <button>aa</button>
                                                </td>
                                            </tr>
                                          @endforeach
                                        </tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile">
                                    <b>Collective Data</b>
                                    <p>
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <th>No</th>
                                            <th>Id Memmo</th>
                                            <th>Full Name</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                          <?php $no = 0; ?>
                                          @foreach($lengkapForBMCol as $data)
                                          <?php $no = $no + 1; ?>
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td><a href='a'>CCBI/SR/{{$data->id_memmo}}</a></td>
                                                <td>Multivalue</td>
                                                <td>
                                                  <button>aa</button>
                                                </td>
                                            </tr>
                                          @endforeach
                                        </tbody>
                                        </tbody>
                                    </table>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="messages">
                                    <b>Message Content</b>
                                    <p>
                                      <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                          <th>No</th>
                                          <th>id memmo</th>
                                          <th>Full Name</th>
                                          <th>Action</th>
                                      </thead>
                                      <tbody>
                                        <?php $noo = 0; ?>
                                      @foreach($lengkapForBMCol as $data)
                                          <?php $noo = $noo + 1; ?>
                                            <tr>
                                                <td>{{$noo}}</td>
                                                <td><a href="#collapseOne_<?php echo $data->id_memmo; ?>" data-toggle="collapse">CCBI/SR/{{$data->id_memmo}}</a></td>
                                                <td>Multivalue</td>
                                                <td>
                                                  <button>Approve</button>
                                                </td>
                                            </tr>
                                            
                                            <div id="collapseOne_<?php echo $data->id_memmo; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_1">
                                                <div class="panel-body">
                                                  <p>aaaa</p>
                                                  </div>
                                              </div>
                                            @endforeach
                                      </tbody>
                                      </table>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="settings">
                                    <b>Settings Content</b>
                                    <p>
                                        Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                        Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                        pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                        sadipscing mel.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Example Tab -->
            
@endsection
<script type="text/javascript">

 $(".button-collapse").sideNav();
$(document).ready(function(){
     Materialize.toast('Ready', 4000) 
});
</script>