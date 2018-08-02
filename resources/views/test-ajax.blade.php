<html>
<head>
    <title>Space-O | Ajax submit form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h1>jQuery post form data using .ajax() method</h1>
<!-- our form -->
    <form id='userForm' method='post'>
    <?php 
    $counter = 0;
        for($i=1;$i<=3;$i++){
            $counter = $counter + 1;
    ?>
    <div><input type='text' name='name<?php echo $i;?>' placeholder='Name' /></div>
    <div><input type='text' name='email<?php echo $i;?>' placeholder='Email' /></div>
    <div><input type='checkbox' name='checkApr<?php echo $i;?>' value='Approve'/>Approve</div>
    <div><input type='checkbox' name='checkRej<?php echo $i;?>' value='Reject'/>Reject</div>
    <?php
        }
        ?>
        <div><input type='text' name='counter' value='<?php echo $counter;?>'/></div>
    <div><input type='submit' value='Submit' /></div>
    </form>
<style type="text/css">
table {
border-collapse: collapse;
}

table, th, td {
border: 1px solid black;
}

</style>
<!-- where the response will be displayed -->
<div id='response'></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
<script>
$(document).ready(function(){
    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    $('#userForm').submit(function(){
        alert('klik');
    // show that something is loading
    $('#response').html("<b>Loading response...</b>");
    var id = 12; 
    $.ajax({
    type: 'POST',
    url: 'getRequest',
    data:$(this).serialize()// getting filed value in serialize form
    })
    .done(function(data){ // if getting done then call.
        alert('done');
    // show the response
     // show the response
     $('#response').html(data);

    })
   

    // to prevent refreshing the whole page page
    return false;

    });
});
</script>

</body>
</html>