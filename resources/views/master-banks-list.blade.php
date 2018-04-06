@extends('master')
@section('page-title','Master Banks')
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
                    <div class="header">
                        <h5>
                            Master Bank
                        </h5>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama Bank</th>
                                    <th>Kode LJK</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama Bank</th>
                                    <th>Kode LJK</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @php $no = 1; @endphp
                                @foreach($data as $datas)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$datas->ID}}</td>
                                        <td>{{$datas->NAMA_BANK}}</td>
                                        <td>{{$datas->KODE_LJK}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection