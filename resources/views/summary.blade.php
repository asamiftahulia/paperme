@extends('master')
@section('page-title','Summary')
@section('content')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-profile">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">PERMOHONAN PERSETUJUAN SPECIAL RATE DEPOSITO</h4>
                                    <p class="category">Time Deposit Special Rate </p>
                                </div>
                                <div class="content">
                                    @foreach($data as $datas)
                                    <h6 class="category text-gray">Nomor Surat : {{$datas['id']}}/CCBI</h6>
                                    <p class="card-content" align="center">
                                        Kepada :Regional</br>
                                        Dari   : Asa </br>
                                    Tanggal : Tanggal </br>

                                    </p>
                                     @endforeach
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <th>ID</th>
                                            <th>Bank</th>
                                            <th>Tipe</th>
                                            <th>Amount</th>
                                            <th>Rate</th>
                                            <th>td</th>
                                            <th>action</th>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            <tr>
                                                @foreach($data as $datas)
                                                <td>{{$datas['id']}} </td>
                                                <td>{{$datas['bank']}} </td>
                                                <td>{{$datas['tipe']}} </td>
                                                <td>{{$datas['amount']}} </td>
                                                <td>{{$datas['rate']}} </td>
                                                <td>{{$datas['td']}} </td>
                                                <td>
                                                     <form action="{{route('customer.destroy',$datas->id)}}" method="post">
                                                            {{csrf_field()}}
                                                            {{method_field('DELETE')}}
                                                            <a href="{{route('customer.edit',$datas->id)}}" class="material-icons">mode_edit</a>
                                                            <a href="{{route('customer.edit',$datas->id)}}" class="material-icons">delete</a>
                                                           <!--  <button class="material-icons" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">delete</button> -->
                                                        </form>
                                                         <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal">Time Deposit Special Rate</button>
                                                           <!-- Default Size -->
            <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        {{$datas->bank}}
                    </div>
                </div>
            </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                       <!--  <a href="{{URL::to('./timedeposit')}}" class="btn btn-primary btn-round">Back</a>
                                    <a href="{{URL::to('timedeposit/list')}}" class="btn btn-primary btn-round">Finish</a> -->
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br><br><br><br><br><br>
@endsection