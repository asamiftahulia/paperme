<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notification New Application</title>
</head>
<body>
    <h1>
        You have a new application to preview 
    </h1>
    <p><b>Go to application <a href='http://bima.ccbi.co.id:3366/login'>bima.ccbi.co.id</a></b></p>
    <div class='row'>
        <table border='1'>
            <tr>
                <th>Id</th>
                <th>Full Name</th>
                <th>Special Rate</th>
                <th>Period</th>
                <th>Date Rollover</th>
                <th>Expired Rollover</th>
                <th>Notes</th>
            </tr>
            <tbody>
                <tr>
                    <td>{{$data[0]->id}}</td>
                    <td>{{$data[0]->full_name}}</td>
                    <td>{{$data[0]->special_rate}} {{$data[0]->currency}}</td>
                    <td>{{$data[0]->period}}</td>
                    <td>{{$data[0]->date_rollover}}</td>
                    <td>{{$data[0]->expired_date}}</td>
                    <td>{{$data[0]->notes}}</td>
                </tr>
            </tbody>    
        </table>
    
        <b>Application Created By : {{$data[0]->created_by}} </b>
</div>
</body>
</html>