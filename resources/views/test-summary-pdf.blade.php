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
                                      {{--@foreach($data as $datas)--}}
                                    <h6 class="category text-gray">Nomor Surat : III/001/CCBI</h6>
                                    <p class="card-content" align="center">
                                        Kepada :Regional</br>
                                        Dari   : Asa </br>
                                        Tanggal : 2018/03/04 </br>
                                    </p>
                                     {{--@endforeach--}}
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <th>ID</th>
                                            <th>Fullname</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Notes</th>
                                            <th>Expired Date</th>
                                            <th>Period</th>
                                            <th>Type Of TD</th>
                                            <th>Id Bank</th>
                                            <th>Date Rollover</th>
                                            <th>Special Rate</th>
                                            <th>Normal Rate</th>
                                            <th>Id Branch</th>
                                            <th>Created By</th>
                                            <th>Updated By</th>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            {{--<tr>--}}
                                                {{--@foreach($data as $datas)--}}
                                                {{--<td>{{$datas['id']}} </td>--}}
                                                {{--<td>{{$datas['full_name']}} </td>--}}
                                                {{--<td>{{$datas['amount']}} </td>--}}
                                                {{--<td>{{$datas['status']}} </td>--}}
                                                {{--<td><a class="material-icons" data-toggle="modal" data-target="#defaultModal">pageview</a>--}}
                                                 {{--<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">--}}
                                                        {{--<div class="modal-dialog" role="document">--}}
                                                            {{--<div class="modal-content">--}}
                                                                {{--{{$datas['notes']}} --}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</td>--}}
                                                {{--<td>{{$datas['expired_date']}} </td>--}}
                                                {{--<td>{{$datas['period']}} </td>--}}
                                                {{--<td>{{$datas['type_of_td']}} </td>--}}
                                                {{--<td>{{$datas['id_bank']}} </td>--}}
                                                {{--<td>{{$datas['date_rollover']}} </td>--}}
                                                {{--<td>{{$datas['special_rate']}} </td>--}}
                                                {{--<td>{{$datas['normal_rate']}} </td>--}}
                                                {{--<td>{{$datas['id_branch']}} </td>--}}
                                                {{--<td>{{$datas['created_by']}} </td>--}}
                                                {{--<td>{{$datas['updated_by']}} </td>--}}
                                                 {{--@endforeach--}}
                                            {{--</tr>--}}
                                        </tbody>
                                    </table>
                                        <a href="{{URL::to('./time-deposit')}}" class="btn btn-primary btn-round">back</a>
                                        <a href="{{URL::to('time-deposit/create')}}" class="btn btn-primary btn-round">Finish</a>
                                        <a href="{{action('TestController@downloadPDF',1)}}" class="btn btn-primary btn-round">Export To PDF</a>
                                </div>
                                </div>

                            </div>
                        </div>
                    </div>
@endsection