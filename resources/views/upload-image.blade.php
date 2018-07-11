<!DOCTYPE html>
<html>
<head>
    <title>Laravel 5.4 Upload Image with Validation example - onlinecode</title>
    <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.css">
</head>
<body>
<div class="container imgdiv">
<div class="panel panel-primary imgdiv">
  <div class="panel-heading imgdiv"><h1>Laravel 5.4 Upload Image with Validation example - onlinecode</h1></div>
  <div class="panel-body imgdiv">
		<!-- count error -->
          @if (count($errors) > 0)
            <div class="alert alert-danger imgdiv">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
					<!-- print  error -->
                    @foreach ($errors->all() as $error_val)
                        <li>{{ $error_val }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($success_message = Session::get('success'))
        <div class="alert alert-success alert-block imgdiv">
            <button type="button" class="close imgdiv" data-dismiss="alert">×</button>
                <strong>{{ $success_message }}</strong>
        </div>
        <img src="images/{{ Session::get('image') }}">
        @endif
    {!! Form::open(array('route' => 'postuplodeimage','files'=>true)) !!}
            <div class="row imgdiv">
                <div class="col-md-6 imgdiv">
                    {!! Form::file('uplode_image_file', array('class' => 'form-control')) !!}
                </div>
                <div class="col-md-6 imgdiv">
                    <button type="submit" class="btn btn-success imgdiv">For Upload Click Hear</button>
                </div>
            </div>
    {!! Form::close() !!}
  </div>
</div>
</div>
</body>
</html>