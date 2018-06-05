@extends('master-dp')
@section('page-title','Time Deposit Special Rate')
@section('aktif-mtimedeplist','active')
@section('content')
    @if(Session::has('flash_message'))
        <div class="alert alert-info">
            <button type="button" aria-hidden="true" class="close">×</button>
            <span><b> Info - </b><em> {!! session('flash_message') !!}</em></span>
        </div>
        @php
            $flash = Session::get('flash_message');
        @endphp
    @endif
    <div class="col-md-12">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Mapping</h4>
                                    Hai {{session('username')}}
                                </div>
                                <div class="card-content table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>nik</th>
                                    <th>branch</th>
                                    <th>job</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{session('nik')}}</td>
                                        <td>{{session('branch')}}</td>
                                        <td>{{session('job')}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection