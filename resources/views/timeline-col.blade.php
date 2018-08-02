@extends('master-dp')
@section('page-title','Timeline Special Rate')
@section('content')

<ol class="breadcrumb breadcrumb-bg-cyan align-left">
    <li><i class="material-icons">home</i> Registration</a></li>
    <li class="active"><i class="material-icons">library_books</i> Summary</a></li>
    <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Timeline</a></li>
</ol>
<div class="col-md-12">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                  <h4 class="title">TIMELINE </br>Time Deposit Special Rate</h4>

                </div></br><font align="center">THIS DATA IS COLLECTIVE</font></br></br>
                <!-- ini mulai BM -->
               
                <ul class="timeline">
<li>
	<div class="direction-r">
		<div class="flag-wrapper">
			<span class="hexa"></span>
			<span class="flag">Branch Manager</span>
			<span class="time-wrapper"><span class="time" id="time">-</span></span>
			</br>
		</div>
		<div class="desc">
			<p id="actionBM1">Waiting An Action From Branch Manager</p>
			<br>
			<input type="button" id="btn-revisi-bm1" data-toggle="modal" data-target="#modalDetailBM" class="btn btn-info btn-sm" value="VIEW DATA">
			<?php
				// }
				?>
		</div>
	</div>
</li>
<!-- //area Manager -->
<li>
	<div class="direction-l">
		<div class="flag-wrapper">
			<span class="hexa"></span>
			<span class="flag">Area Manager</span>
			<span class="time-wrapper"><span class="time" id="time">-</span></span>
			</br>
		</div>
		<div class="desc">
			<p id="actionBM1">Waiting An Action From Area Manager</p>
			<br>
			<input type="button" id="btn-revisi-bm1" data-toggle="modal" data-target="#modalDetailAM" class="btn btn-info btn-sm" value="VIEW DATA">
			<?php
				// }
				?>
		</div>
	</div>
</li>
<!-- //Regional Head -->
<li>
	<div class="direction-r">
		<div class="flag-wrapper">
			<span class="hexa"></span>
			<span class="flag">Regional Head</span>
			<span class="time-wrapper"><span class="time" id="time">-</span></span>
			</br>
		</div>
		<div class="desc">
			<p id="actionBM1">Waiting An Action From Regional Head</p>
			<br>
			<input type="button" id="btn-revisi-bm1" data-toggle="modal" data-target="#modalDetailRH" class="btn btn-info btn-sm" value="VIEW DATA">
			<?php
				// }
				?>
		</div>
	</div>
</li>
<!-- Modal BM -->
<div class="modal fade" id="modalDetailBM" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
				<div class="modal-header">
				</div>
			</div>
			<div class="modal-body">
				<div class="card">
					<div class="card-header" data-background-color="blue">
						<h4 class="title">List Data Collective</h4>
						<p class="category">Created By </p>
					</div>
					<div class="card-content table-responsive">
						<form id='userForm' method='post'>
							{{csrf_field()}}
							<table class="table">
								<thead class="text-primary">
									<th width='50%'>Full Name</th>
									<th width='20%'>Special Rate</th>
									<th>Action</th>
									<!-- <th>Status</th> -->
								</thead>
								<tbody>
									<?php 
										$counter = 0; 
										$arr = [];
										?>
									@foreach($data as $datas)
									<?php $counter = $counter + 1; 
										$arr[$counter] = $datas->id;
										?>
									<tr>
										<td>{{$datas->full_name}}
											<input type='hidden' name='id_td<?php echo $counter;?>' value='{{$datas->id}}' /> 
											<input type='hidden' name='name<?php echo $counter;?>' value='{{$datas->full_name}}'/>
										</td>
										<td>
											<input type='text' name='special_rate<?php echo $counter;?>' value='{{$datas->special_rate}}' id='special_rate' class='form-control'/>
										</td>
										<td>
                                            <input type='radio' name='aksi<?php echo $counter;?>' value='Approve'/>Approve
                                            <input type='hidden' name='role<?php echo $counter;?>' value='Branch Manager'/>
					</div>
					<div><input type='radio' name='aksi<?php echo $counter;?>' value='Reject'/>Reject</div>
					</td>
					<!-- <td class="text-primary">$36,738</td> -->
					</tr>
					@endforeach
					<div><input type='hidden' name='counter' value='<?php echo $counter;?>'/></div>
					</tbody>
					</table>
					<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
					<input type='submit' value='Submit' class="btn btn-success" />
					</form>
				</div>
			</div>
			<div id="response2"></div>
		</div>
	</div>
</div>
</div>
<!-- Modal AM -->
<div class="modal fade" id="modalDetailAM" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
				<div class="modal-header">
				</div>
			</div>
			<div class="modal-body">
				<div class="card">
					<div class="card-header" data-background-color="blue">
						<h4 class="title">List Data Collective</h4>
						<p class="category">Created By </p>
					</div>
					<div class="card-content table-responsive">
						<form id='userForm2' method='post'>
							{{csrf_field()}}
							<table class="table">
								<thead class="text-primary">
									<th width='50%'>Full Name</th>
									<th width='20%'>Special Rate</th>
									<th>Action</th>
									<!-- <th>Status</th> -->
								</thead>
								<tbody>
									<?php 
										$counter = 0; 
										$arr = [];
										?>
									@foreach($data as $datas)
									<?php $counter = $counter + 1; 
										$arr[$counter] = $datas->id;
										?>
									<tr>
										<td>{{$datas->full_name}}
											<input type='hidden' name='id_td<?php echo $counter;?>' value='{{$datas->id}}' /> 
											<input type='hidden' name='name<?php echo $counter;?>' value='{{$datas->full_name}}'/>
										</td>
										<td>
											<input type='text' name='special_rate<?php echo $counter;?>' value='{{$datas->special_rate}}' id='special_rate' class='form-control'/>
										</td>
										<td>
                                            <input type='radio' name='aksi<?php echo $counter;?>' value='Approve'/>Approve
                                            <input type='hidden' name='role<?php echo $counter;?>' value='Area Manager'/>
					</div>
					<div><input type='radio' name='aksi<?php echo $counter;?>' value='Reject'/>Reject</div>
					</td>
					<!-- <td class="text-primary">$36,738</td> -->
					</tr>
					@endforeach
                    <input type='hidden' name='counter' value='<?php echo $counter;?>'/>
                  
					</tbody>
					</table>
					<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
					<input type='submit' value='Submit' class="btn btn-success" />
					</form>
				</div>
			</div>
			<div id="response"></div>
		</div>
	</div>
</div>
</div>
<!-- //modal RH -->
<div class="modal fade" id="modalDetailRH" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="defaultModalLabel">Detail Deposan</h4>
				<div class="modal-header">
				</div>
			</div>
			<div class="modal-body">
				<div class="card">
					<div class="card-header" data-background-color="blue">
						<h4 class="title">List Data Collective</h4>
						<p class="category">Created By </p>
					</div>
					<div class="card-content table-responsive">
						<form id='userForm3' method='post'>
							{{csrf_field()}}
							<table class="table">
								<thead class="text-primary">
									<th width='50%'>Full Name</th>
									<th width='20%'>Special Rate</th>
									<th>Action</th>
									<!-- <th>Status</th> -->
								</thead>
								<tbody>
									<?php 
										$counter = 0; 
										$arr = [];
										?>
									@foreach($data as $datas)
									<?php $counter = $counter + 1; 
										$arr[$counter] = $datas->id;
										?>
									<tr>
										<td>{{$datas->full_name}}
											<input type='hidden' name='id_td<?php echo $counter;?>' value='{{$datas->id}}' /> 
											<input type='hidden' name='name<?php echo $counter;?>' value='{{$datas->full_name}}'/>
										</td>
										<td>
											<input type='text' name='special_rate<?php echo $counter;?>' value='{{$datas->special_rate}}' id='special_rate' class='form-control'/>
										</td>
										<td>
                                            <input type='radio' name='aksi<?php echo $counter;?>' value='Approve'/>Approve
                                            <input type='hidden' name='role<?php echo $counter;?>' value='Regional Head'/>
					</div>
					<div><input type='radio' name='aksi<?php echo $counter;?>' value='Reject'/>Reject</div>
					</td>
					<!-- <td class="text-primary">$36,738</td> -->
					</tr>
					@endforeach
					<div><input type='hidden' name='counter' value='<?php echo $counter;?>'/></div>
					</tbody>
					</table>
					<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
					<input type='submit' value='Submit' class="btn btn-success" />
					</form>
				</div>
			</div>
			<div id="response3"></div>
		</div>
	</div>
</div>
</div>
</div>
</div>
@endsection

<style type="text/css">
table {
border-collapse: collapse;
}

table, th, td {
border: 1px solid black;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
<script>
$(document).ready(function(){
    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    $('#userForm').submit(function(){

    // show that something is loading
    $('#response').html("<b>Loading response...</b>");

    // Call ajax for pass data to other place
    var id = 12; 
    $.ajax({
    type: 'POST',
    url: 'getRequest',
    data:$(this).serialize()// getting filed value in serialize form
    })
    .done(function(data){ // if getting done then call.

    // show the response
     // show the response
     $('#response').html(data);

    })
    .fail(function() { // if fail then getting message

    // just in case posting your form failed
    alert('failed');

    });

    // to prevent refreshing the whole page page
    return false;

    });

    $('#userForm2').submit(function(){

        // show that something is loading
        $('#response2').html("<b>Loading response...</b>");

        // Call ajax for pass data to other place
        var id = 12; 
        $.ajax({
        type: 'POST',
        url: 'getRequest',
        data:$(this).serialize()// getting filed value in serialize form
        })
        .done(function(data){ // if getting done then call.

        // show the response
        // show the response
        $('#response').html(data);

        })
        .fail(function() { // if fail then getting message

        // just in case posting your form failed
        alert('failed');

        });

        // to prevent refreshing the whole page page
        return false;

    });

    $('#userForm3').submit(function(){

        // show that something is loading
        $('#response3').html("<b>Loading response...</b>");

        // Call ajax for pass data to other place
        var id = 12; 
        $.ajax({
        type: 'POST',
        url: 'getRequest',
        data:$(this).serialize()// getting filed value in serialize form
        })
        .done(function(data){ // if getting done then call.

        // show the response
        $('#response3').html(data);

        })
        .fail(function() { // if fail then getting message

        // just in case posting your form failed
        alert('failed');

        });

        // to prevent refreshing the whole page page
        return false;

        });
});
</script>

</body>
</html>