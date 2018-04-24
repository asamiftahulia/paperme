
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Summary Time Deposit Special Rate </title>
    <link rel="stylesheet" href="{{asset('css/style-pdf.css')}}" media="all" />
</head>
<body>
<header class="clearfix">
    <div id="logo">
        <img src="{{asset('css/lo.png')}}">
    </div>
    <div id="company">
        <h2 class="name">China Construction Bank Indonesia</h2>
        <div>Equity Tower Lt. 9,Sudirman Central Business District (SCBD) Lot 9</div>
        <div>(021)-51401707</div>
        <div><a href="mailto:company@example.com">ccb@idn.com</a></div>
    </div>
    </div>
</header>
<main>
    <div id="details" class="clearfix">
        <div id="client">
             @foreach($data as $datas)
                                   
                                    
            <div class="to">Time Deposit To :</div>
            <h2 class="name">{{$datas['full_name']}}</h2>
            <div class="address">New Deposan</div>
            <div class="email"><a href="mailto:john@example.com">john@example.com</a></div>
           
        </div>
        <div id="invoice">
            <h1>Summary Time Deposit</h1>
            <div class="date">Date of Invoice: 12/12/2018</div>
            <div class="date">Due Date: 12/12/2018</div>
        </div>
    </div>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
           
            <td class="desc">DESCRIPTION</th>
            <th class="unit">AMOUNT</th>
            <th class="qty">SPECIAL RATE</th>
            <th class="total">TOTAL</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            
            <td class="desc"><h3><font color='red'>New Deposan</font></h3>Creating a summary time deposit Special Rate</td>
            <td class="unit">{{$datas['amount']}}</td>
            <td class="qty">{{$datas['special_rate']}}</td>
            <td class="total">{{$datas['amount']}}</td>
        </tr>
         <tr>
            <th class="no" colspan="5" align="center">APPROVER</th>
        </tr>
        <tr>
             <td class="desc">BRANCH MANAGER <input type="checkbox" checked="true" /></td>
            <td class="desc">AREA <input type="checkbox" checked="true"/></td>
            <td class="desc">REGIONAL <input type="checkbox" checked="true"/></td>
            <td class="desc">DIRECTOR <input type="checkbox" checked="true"/></td>
        </tr>
        </tbody>
    </table>
      @endforeach
   <!--  <div id="thanks">Thank you!</div>
    <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
    </div> -->
    <div id="notices">
        <a href="{{URL::to('./')}}" class="btn btn-primary waves-effect"> Back </a>|
        <a href="{{route('td.edit',$datas->id)}}">Edit</a>|
        <a href="{{route('td.create')}}">Add Customer</a>|
        <a href="{{action('TDController@downloadSummary',1)}}">Export To PDF</a>|
        <a href="{{action('TDController@timeline',1)}}">Submit</a>

    </div>
</main>
<footer>
    Invoice was created on a computer and is valid without the signature and seal.
</footer>
</body>
</html>