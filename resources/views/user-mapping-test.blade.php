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
                                    <h4 class="title">User Mapping</h4>
                                    Hai {{session('username')}} </br>
                                    NIK : {{session('nik')}} </br>
                                    BRANCH : {{session('branch')}} </br>
                                    JOB : {{session('job')}}</br>
                                </div>
                                <div class="card-content table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>flow cabang
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Regional</th>
                                    <th>Path</th>
                                    <th>Path Name</th>
                                    <th>Jenis Cabang</th>
                                </tr>
                                </thead>
                                <tbody>
                               
                                @foreach($flow as $data)
                                <?php
                                    $id = explode(';',$data->path);
                                    $path = explode(';',$data->path);
                                    $pathName = explode('->',$data->path_name);
                                    $jenisCabang = explode(';',$data->jenis_cabang);
                                ?>
                                    <tr>
                                       <td>{{$id[0]}}</td>
                                       <td>{{$data->nama}}</td>
                                       <td>{{$data->regional}}</td>
                                       <td><?php
                                            for($i = 0; $i<count($path);$i++){
                                                echo $path[$i];
                                                echo'</br>';
                                            }?>
                                       </td>
                                       <td><?php
                                            for($i = 0; $i<count($pathName);$i++){
                                                echo $pathName[$i];
                                                echo'</br>';
                                            }?>
                                       </td>
                                       <td>
                                       <?php
                                            for($i = 0; $i<count($jenisCabang);$i++){
                                                echo $jenisCabang[$i];
                                                echo'</br>';
                                            }?>
                                       </td>
                                       
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <table border='1'>
                                <thead>User BM 
                                        <!-- </br>aasasasa {{$userBM}} -->
                                <tr>
                                    <th>Username</th>
                                    <th>job</th>
                                    <th>Id Branch</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userBM as $user)
                                    <tr>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->id_jobs}}</td>
                                        <td>{{$user->id_branch}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <table border='1'>
                                <thead>User AM 
                                <tr>
                                    <th>Username</th>
                                    <th>job</th>
                                    <th>Id Branch</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userAM as $user)
                                    <tr>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->id_jobs}}</td>
                                        <td>{{$user->id_branch}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                             <table border='1'>
                                <thead>User Regional Head 
                                <tr>
                                    <th>Username</th>
                                    <th>job</th>
                                    <th>Id Branch</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userRH as $user)
                                    <tr>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->id_jobs}}</td>
                                        <td>{{$user->id_branch}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <table border='1'>
                                <thead>User Director 
                                <tr>
                                    <th>Username</th>
                                    <th>job</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$userDR}}</td>
                                        <td>S0384}</td>
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
        </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection