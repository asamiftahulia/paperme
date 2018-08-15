
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

    <!-- <div id="logo">
        <img src="{{asset('css/lo.png')}}">
    </div> -->
    @foreach($namaApprover as $dataa)

    @php
    $month = date('m', strtotime($dataa->date_rollover));
    $year = date('Y', strtotime($dataa->date_rollover));
    
    $branch = substr ($dataa->id_branch ,-3);
    @endphp

    <H2 align='center'><b>PERMOHONAN PERSETUJUAN SPECIAL RATE DEPOSITO</b></H2>
    <H3 align='center'>Nomor Surat : 0{{$dataa->id}}/CCBI/{{$branch}}/SR/{{$month}}/{{$year}}</H3>
    <h4>Kepada : 
    <?php
            if($dataa->approver == 3){
                $kpd = $dataa->rh;
            }else if($dataa->approver == 2){
                $kpd = $dataa->am;
            }else if($dataa->approver == 4){
                $kpd = $dataa->dr;
            }
    ?>
        {{$kpd}}
    </h4>
    <h4>Diajukan Oleh : {{$dataa->created_by}}</h4>
    <h4>Tanggal : {{$dataa->date_rollover}}</h4>
    </div>

    @endforeach
</header>
<main>
<?php $no = 0; ?>
@foreach($data as $datas)
<?php $no = $no + 1; ?>
    <table border='2'>
        <thead>
        <tr>
            <th class="desc">No</th>
            <th class="desc">Nama</th>
            <th class="desc">Nominal Deposit</th>
            <th class="unit">Tanggal Rollover</th>
            <th class="unit">Tanggal Jatuh Tempo</th>
            <th class="unit">Period</th>
            <th class="total">Counter Rate (%)</th>
            <th class="total">Special Rate (%)</th>
            <th>Keterangan </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="desc">{{$no}}</td>
            <td class="desc">{{$datas->full_name}}</td>
            <td class="desc">{{number_format($datas->amount,0)}} {{$datas->currency}}</td>
            <td class="unit">{{$datas->date_rollover}}</td>
            <td class="qty">{{$datas->expired_date}}</td>
            <td class="qty">{{$datas->period}} Bulan</td>
            <td class="total">-</td>
            <td class="total"><b>{{$datas->special_rate}}</b></td>
            <td class="total"><b>{{$datas->notes}}</b></td>
        </tr>
        </tbody>
    </table>
    @endforeach

    <div id="thanks"></div>
    <br><br><br><br><br><br><br><br>

    <table border="1" style="width:100%">
        <tr>
            <th>Approved At</th>
            <th>Approved By</th>
            <th>Jabatan </th>
        </tr>
    
        @foreach($datalengkap as $aprover)
        <tr>
            <th>{{$aprover->created_at}}</th>
            <th>{{$aprover->approved_by}}</th>
            <th>{{$aprover->role}}</th>
        </tr>
            @endforeach
      
        <!-- <tr>
            <td>{{$aprover->created_at}}</td>
        </tr>
        <tr>
            <td>{{$aprover->approved_by}}</td>
        </tr>
        <tr>
            <td>{{$aprover->role}}</td>
        </tr> -->
   
    </table>

</main>
<footer>
Proposal ini diajukan dan disetujui melalui system sehingga tidak memerlukan tanda tangan
</footer>
</body>
</html>
