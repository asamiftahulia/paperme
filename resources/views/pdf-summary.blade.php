
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PERMOHONAN PERSETUJUAN SPECIAL RATE DEPOSITO </title>
    <link rel="stylesheet" href="{{asset('css/style-pdf.css')}}" media="all" />
    <link href="{{asset('/assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
</head>
<body>
<header class="clearfix">
@foreach($data as $datas)
    <!-- <div id="logo">
        <img src="{{asset('css/lo.png')}}">
    </div> -->
    @php
    $month = date('m', strtotime($datas->date_rollover));
    $year = date('y', strtotime($datas->date_rollover));
    @endphp

    <H2 align='center'><b>PERMOHONAN PERSETUJUAN SPECIAL RATE DEPOSITO</b></H2>
    <H3 align='center'>Nomor Surat : 0{{$datas->id}}/CCBI/SR/{{$month}}/{{$year}}</H3>
    <h4>Kepada : REGIONAL</h4>
    <h4>Dari : BRANCH</h4>
    <h4>Tanggal : {{$datas->date_rollover}}</h4>
    </div>
</header>
<main>
    <div id="details" class="clearfix">
        <div id="client">
            <div class="to">Time Deposit To :</div>
            <h2 class="name">{{$datas->full_name}}</h2>
            <div class="address">New Deposit</div>
            <div class="email"><a href="mailto:john@example.com">New Deposan</a></div>
            @endforeach
        </div>
    </div>
    <table border='2'>
        <thead>
        <tr>
            <th class="desc">Nominal Deposit</th>
            <th class="unit">Tanggal Rollover</th>
            <th class="unit">Tanggal Jatuh Tempo</th>
            <th class="unit">Period</th>
            <th class="total">Normal Rate (%)</th>
            <th class="total">Special Rate (%)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="desc">{{$datas->amount}}</td>
            <td class="unit">{{$datas->date_rollover}}</td>
            <td class="qty">{{$datas->expired_date}}</td>
            <td class="qty">{{$datas->period}}</td>
            <td class="total">{{$datas->normal_rate}}</td>
            <td class="total"><b>{{$datas->special_rate}}</b></td>
        </tr>
        </tbody>
    </table>

    <div id="thanks"></div>
    <div id="notices">
        <div>NOTE:</div>
        <div class="notice">{{$datas->notes}}</div>
    </div>
    <br><br>

    <table border="1" style="width:100%">
        <tr>
            <th>Role</th>
            <th>Approved At</th>
            <th>Approved By</th>
        </tr>
        @foreach($datalengkap as $aprover)
        <tr>
            <td>Proposed By : {{$aprover->role}}</td>
            <td>{{$aprover->approved_at}}</td>
            <td>Approved By : {{$aprover->approved_by}}</td>
        </tr>
        @endforeach
        
    </table>

</main>
<footer>
    Permohonan Persetujuan Special Rate Deposito
</footer>
</body>
</html>
