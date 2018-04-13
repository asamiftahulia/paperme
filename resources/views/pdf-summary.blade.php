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
            <div class="to">Time Deposit To :</div>
            <h2 class="name">{{$data->full_name}}</h2>
            <div class="address">796 Silver Harbour, TX 79273, US</div>
            <div class="email"><a href="mailto:john@example.com">john@example.com</a></div>
        </div>
        <div id="invoice">
            <h1>INVOICE 3-2-1</h1>
            <div class="date">Date of Invoice: 01/06/2014</div>
            <div class="date">Due Date: 30/06/2014</div>
        </div>
    </div>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPTION</th>
            <th class="unit">UNIT PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="total">TOTAL</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="no">01</td>
            <td class="desc"><h3>Website Design</h3>Creating a recognizable design solution based on the company's existing visual identity</td>
            <td class="unit">$40.00</td>
            <td class="qty">30</td>
            <td class="total">$1,200.00</td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>$5,200.00</td>
        </tr>

        </tfoot>
    </table>
    <div id="thanks">Thank you!</div>
    <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
    </div>
</main>
<footer>
    Invoice was created on a computer and is valid without the signature and seal.
</footer>
</body>
</html>