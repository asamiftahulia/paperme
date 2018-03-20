@extends('master')
@section('page-title','Customer List')
@section('content')
@if(Session::has('flash_message'))
<div class="alert alert-info">
    <button type="button" aria-hidden="true" class="close">×</button>
    <span><b> Info - </b><em> {!! session('flash_message') !!}</em></span>
        </div>
@php
    $flash = Session::get('flash_message');
@endphp
<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.showNotification('top', 'right');

    });
    $notif = '<?php echo $flash; ?>';
    //demo.showNotification('top', 'right');
</script>

   
@endif
                    <div class="col-md-12">
                            <div class="card card-plain">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Table on Plain Background</h4>
                                    <p class="category">Here is a subtitle for this table</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach($data as $datas)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$datas->fullname}}</td>
                                                <td>{{$datas->email}}</td>
                                                <td>{{$datas->phone_number}}</td>
                                                <td>{{$datas->address}}</td>
                                                <td>
                                                    <form >
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
@endsection