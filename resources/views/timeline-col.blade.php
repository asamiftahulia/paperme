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

                </div></br>
				<!-- <font align="center">THIS DATA IS COLLECTIVE <?php echo $maksApprover;?></font></br></br> -->
                <!-- ini mulai BM -->
 <?php
	$rm = '';
	$bm = '';
	$am = '';
	$rh ='';
	$dr ='';
	foreach($allData as $orang){
		$rm = $orang->created_by;
		$bm = $orang->bm;
		$am = $orang->am;
		$rh = $orang->rh;
		$dr = $orang->dr;
	}
	// $userLogin = ;
 ?>
 <ul class="timeline">
<li>
	<div class="direction-r">
		<div class="flag-wrapper">
			<span class="hexa"></span>
			<span class="flag">Branch Manager</span>
			<span class="time-wrapper"><span class="time" id="time-bm">-</span></span>
			</br>
		</div>
		<div class="desc">
			<?php 
				$rejected = 0;
				foreach($tempStatusBM as $aksiBM){
					if($aksiBM == 'Reject'){
						$rejected = 1;
					}
				}
				?>
			<?php
				if($rejected==0){ ?>
					<p id="act-bm">Waiting an action from Branch Manager</p>
		<?php	}else if($rejected == 1){
		?>
					<p id="act-bm">This Special Rate Has Been<font color="red"> Rejected </font>By Branch Manager</p>
		<?php	
				}else{
		?>
				<p id="act-bm">Waiting an action from Branch Manager</p>
		<?php		}
			?>
			<br>
			<?php 
				if(session('username')==$bm){
			?>
			<input type="button" id="btn-revisi-bm1" data-toggle="modal" data-target="#modalDetailBM" class="btn btn-info btn-sm" value="VIEW DATA">
			<?php
				 }
				?>
		</div>
	</div>
</li>
<!-- //area Manager -->
<?php
	if($maksApprover >= 2){
?>
<li>
	<div class="direction-l">
		<div class="flag-wrapper">
			<span class="hexa"></span>
			<span class="flag">Area Manager</span>
			<span class="time-wrapper"><span class="time" id="time-am">-</span></span>
			</br>
		</div>
		<div class="desc">
		<?php 
				$rejected = 0;
				foreach($tempStatusAM as $aksiAM){
					if($aksiAM == 'Reject'){
						$rejected = 1;
					}
				}
				?>
			<?php
				if($rejected==0){ ?>
					<p id="act-am">Waiting an action from Area Manager</p>
		<?php	}else if($rejected == 1){
		?>
					<p id="act-am">This Special Rate Has Been<font color="red"> Rejected </font>By Area Manager</p>
		<?php	
				}else{
		?>
				<p id="act-am">Waiting an action from Area Manager</p>
		<?php		}
			?>
			<br>
			<?php
				if(session('username')==$am){
			?>
			<input type="button" id="btn-revisi-bm1" data-toggle="modal" data-target="#modalDetailAM" class="btn btn-info btn-sm" value="VIEW DATA">
			<?php
				}
				?>
		</div>
	</div>
</li>
<!-- //Regional Head -->
<?php
}if($maksApprover >= 3){
?>
<li>
	<div class="direction-r">
		<div class="flag-wrapper">
			<span class="hexa"></span>
			<span class="flag">Regional Head</span>
			<span class="time-wrapper"><span class="time" id="time-rh">-</span></span>
			</br>
		</div>
		<div class="desc">
		<?php 
				$rejected = 0;
				foreach($tempStatusRH as $aksiRH){
					if($aksiRH == 'Reject'){
						$rejected = 1;
					}
				}
				?>
			<?php
				if($rejected==0){ ?>
					<p id="act-rh">This Special Rate Has Been<font color="green"> Approved </font>By Regional Head</p>
		<?php	}else if($rejected == 1){
		?>
					<p id="act-rh">This Special Rate Has Been<font color="red"> Rejected </font>By Regional Head</p>
		<?php	
				}else{
		?>
				<p id="act-rh">Waiting an action from Regional Head</p>
		<?php		}
			?>
			<br>
			<?php
				if(session('username')==$rh){
			?>
			<input type="button" id="btn-revisi-bm1" data-toggle="modal" data-target="#modalDetailRH" class="btn btn-info btn-sm" value="VIEW DATA">
			<?php
				}
				?>
		</div>
	</div>
</li>
<?php
}if($maksApprover >= 4 ){
	?>
<li>
	<div class="direction-l">
		<div class="flag-wrapper">
			<span class="hexa"></span>
			<span class="flag">Director</span>
			<span class="time-wrapper"><span class="time" id="time-dr">-</span></span>
			</br>
		</div>
		<div class="desc">
			<p id="act-dr">Waiting An Action From Director</p>
			<br>
			<?php
				if(session('username')==$dr){
			?>
			<input type="button" id="btn-revisi-bm1" data-toggle="modal" data-target="#modalDetailDR" class="btn btn-info btn-sm" value="VIEW DATA">
			<?php
				}
				?>
		</div>
	</div>
</li>
<?php
}
?>
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
										$i = 0; 
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
                                            <input type='radio' name='aksi<?php echo $counter;?>' id='aksiApprove<?php echo $counter;?>' value='Approve'/>Approve
                                            <input type='hidden' name='role<?php echo $counter;?>' value='Branch Manager'/>
									</div>
									<div><input type='radio' name='aksi<?php echo $counter;?>' id='aksiReject<?php echo $counter;?>'value='Reject'/>Reject</div>
									</td>
					<!-- <td class="text-primary">$36,738</td> -->
									</tr>
					<?php 
						$i=$i+1;
					?>
					@endforeach	
									<tr>
										<td>
										Approve: <input type="checkbox" id="checkApproveAll">
										Reject: <input type="checkbox" id="checkRejectAll">
										<input type="radio" value="Approve" name="aksiApprove" id="aksiReject">Reject
										</td>
									</tr>
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
                                            <input type='radio' name='aksi<?php echo $counter;?>' id='aksiApproveAM<?php echo $counter;?>' value='Approve'/>Approve
                                            <input type='hidden' name='role<?php echo $counter;?>' value='Area Manager'/>
					</div>
					<div><input type='radio' name='aksi<?php echo $counter;?>' id='aksiRejectAM<?php echo $counter;?>' value='Reject'/>Reject</div>
					</td>
					<!-- <td class="text-primary">$36,738</td> -->
					</tr>
					@endforeach
					<tr>
										<td>
										Approve: <input type="checkbox" id="checkApproveAllAM">
										Reject: <input type="checkbox" id="checkRejectAllAM">
										<input type="radio" value="Approve" name="aksiApprove" id="aksiReject">Reject
										</td>
									</tr>
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
                                            <input type='radio' name='aksi<?php echo $counter;?>' id='aksiApproveRH<?php echo $counter;?>' value='Approve'/>Approve
                                            <input type='hidden' name='role<?php echo $counter;?>' value='Regional Head'/>
										</div>
										<div><input type='radio' name='aksi<?php echo $counter;?>' id='aksiRejectRH<?php echo $counter;?>' value='Reject'/>Reject</div>
										</td>
										<!-- <td class="text-primary">$36,738</td> -->
										</tr>
										@endforeach
									<tr>
										<td>
										Approve: <input type="checkbox" id="checkApproveAllRH">
										Reject: <input type="checkbox" id="checkRejectAllRH">
										<input type="radio" value="Approve" name="aksiApprove" id="aksiReject">Reject
										</td>
									</tr>
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
<!-- //Modal DR -->

<!-- Modal BM -->
<div class="modal fade" id="modalDetailDR" tabindex="-1" role="dialog">
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
						<form id='userForm4' method='post'>
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
                                            <input type='radio' name='aksi<?php echo $counter;?>' id='aksiApproveDR<?php echo $counter;?>' value='Approve'/>Approve
                                            <input type='hidden' name='role<?php echo $counter;?>' value='Director'/>
					</div>
					<div><input type='radio' name='aksi<?php echo $counter;?>' id='aksiRejectDR<?php echo $counter;?>' value='Reject'/>Reject</div>
					</td>
					<!-- <td class="text-primary">$36,738</td> -->
					</tr>
					@endforeach
							<tr>
								<td>Approve: <input type="checkbox" id="checkApproveAllDR">
									Reject: <input type="checkbox" id="checkRejectAllDR">
									<input type="radio" value="Approve" name="aksiApprove" id="aksiReject">Reject
								</td>
							</tr>
					<div><input type='hidden' name='counter' value='<?php echo $counter;?>'/></div>
					</tbody>
					</table>
					<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
					<input type='submit' value='Submit' class="btn btn-success" />
					</form>
				</div>
			</div>
			<div id="response4"></div>
		</div>
	</div>
</div>
</div>
		<div class="row" align="right">
                <a align="center" href="{{route('td.index')}}"><input type="button" id="btn-submit" class="btn btn-warning" value="Back To List Time Deposit"></a>
				<?php
				if(session('username')!=$rm){
				?>
                      <a align="center" href="{{url('td/updateStatus',$datas->id)}}"><input type="button"  id="btn-finish"  class="btn btn-info" value="FINISH"></a>
                <?php
				}
				?>
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

var counterr = '<?php echo $counter;?>';
const checkboxApprove = document.getElementById('checkApproveAll')
const checkboxReject = document.getElementById('checkRejectAll')

checkboxApprove.addEventListener('change', (event) => {
  if (event.target.checked) {
    console.log('checked')
	console.log(counterr)
	for(i = 1; i<=counterr;i++){
	document.getElementById('aksiApprove'+i).checked = true;
	}
  } else {
    console.log('not checked')
	for(i = 1; i<=counterr;i++){
	document.getElementById('aksiApprove'+i).checked = false;
	}
	
  }
});

checkboxReject.addEventListener('change', (event) => {
  if (event.target.checked) {
    console.log('checked')
	for(i = 1; i<=2;i++){
	document.getElementById('aksiReject'+i).checked = true;
	}
  } else {
    console.log('not checked')
	for(i = 1; i<=2;i++){
	document.getElementById('aksiReject'+i).checked = false;
	}
	
  }
});

const checkboxApproveAM = document.getElementById('checkApproveAllAM')
const checkboxRejectAM = document.getElementById('checkRejectAllAM')

checkboxApproveAM.addEventListener('change', (event) => {
  if (event.target.checked) {
    console.log('checked')
	console.log(counterr)
	for(i = 1; i<=counterr;i++){
	document.getElementById('aksiApproveAM'+i).checked = true;
	}
  } else {
    console.log('not checked')
	for(i = 1; i<=counterr;i++){
	document.getElementById('aksiApproveAM'+i).checked = false;
	}
	
  }
});

checkboxRejectAM.addEventListener('change', (event) => {
  if (event.target.checked) {
    console.log('checked')
	for(i = 1; i<=2;i++){
	document.getElementById('aksiRejectAM'+i).checked = true;
	}
  } else {
    console.log('not checked')
	for(i = 1; i<=2;i++){
	document.getElementById('aksiRejectAM'+i).checked = false;
	}
	
  }
});

const checkboxApproveRH = document.getElementById('checkApproveAllRH')
const checkboxRejectRH = document.getElementById('checkRejectAllRH')

checkboxApproveRH.addEventListener('change', (event) => {
  if (event.target.checked) {
    console.log('checked')
	console.log(counterr)
	for(i = 1; i<=counterr;i++){
	document.getElementById('aksiApproveRH'+i).checked = true;
	}
  } else {
    console.log('not checked')
	for(i = 1; i<=counterr;i++){
	document.getElementById('aksiApproveRH'+i).checked = false;
	}
	
  }
});

checkboxRejectRH.addEventListener('change', (event) => {
  if (event.target.checked) {
    console.log('checked')
	for(i = 1; i<=2;i++){
	document.getElementById('aksiRejectRH'+i).checked = true;
	}
  } else {
    console.log('not checked')
	for(i = 1; i<=2;i++){
	document.getElementById('aksiRejectRH'+i).checked = false;
	}
	
  }
});


const checkboxApproveDR = document.getElementById('checkApproveAllDR')
const checkboxRejectDR = document.getElementById('checkRejectAllDR')

checkboxApproveDR.addEventListener('change', (event) => {
  if (event.target.checked) {
    console.log('checked')
	console.log(counterr)
	for(i = 1; i<=counterr;i++){
	document.getElementById('aksiApproveDR'+i).checked = true;
	}
  } else {
    console.log('not checked')
	for(i = 1; i<=counterr;i++){
	document.getElementById('aksiApproveDR'+i).checked = false;
	}
	
  }
});

checkboxRejectDR.addEventListener('change', (event) => {
  if (event.target.checked) {
    console.log('checked')
	for(i = 1; i<=2;i++){
	document.getElementById('aksiRejectDR'+i).checked = true;
	}
  } else {
    console.log('not checked')
	for(i = 1; i<=2;i++){
	document.getElementById('aksiRejectDR'+i).checked = false;
	}
	
  }
});
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

if(dd<10) {
    dd = '0'+dd
} 

if(mm<10) {
    mm = '0'+mm
} 

today = dd + '-' + mm + '-' + yyyy;

    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    $('#userForm').submit(function(){
		checkboxApprove.addEventListener('change', (event) => {
		if (event.target.checked) {
			console.log('checked')
			for(i = 1; i<=2;i++){
			document.getElementById('aksiApprove'+i).checked = true;
			}
		} else {
			console.log('not checked')
			for(i = 1; i<=2;i++){
			document.getElementById('aksiApprove'+i).checked = false;
			}
			
		}
		});
    // show that something is loading
    $('#response').html("<b>Loading response...</b>");




    // Call ajax for pass data to other place
	
    $.ajax({
    type: 'POST',
    url: 'getRequest',
    data:$(this).serialize()// getting filed value in serialize form
    })
    .done(function(data){ // if getting done then call.

    // show the response
     $('#response').html(data);
	 document.getElementById("act-bm").innerHTML = "This Special Rate Has Been <font color='green'>Approved</font> by Branch Manager";
	 document.getElementById("time-bm").innerHTML = today;	

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
		document.getElementById("act-am").innerHTML = "This Special Rate Has Been <font color='green'>Approved</font> by Area Manager";
		document.getElementById("time-am").innerHTML = today;	
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
		document.getElementById("act-rh").innerHTML = "This Special Rate Has Been <font color='green'>Approved</font> by Regional Head";
		document.getElementById("time-rh").innerHTML = today;	
        })
        .fail(function() { // if fail then getting message

        // just in case posting your form failed
        alert('failed');

        });

        // to prevent refreshing the whole page page
        return false;

        });

		$('#userForm4').submit(function(){

		// show that something is loading
		$('#response4').html("<b>Loading response...</b>");

		// Call ajax for pass data to other place
		var id = 12; 
		$.ajax({
		type: 'POST',
		url: 'getRequest',
		data:$(this).serialize()// getting filed value in serialize form
		})
		.done(function(data){ // if getting done then call.

		// show the response
		$('#response4').html(data);
		var actDr = document.getElementById("act-dr").innerHTML = "This Special Rate Has Been <font color='green'>Approved</font> by Director";
		document.getElementById("time-dr").innerHTML = today;	
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