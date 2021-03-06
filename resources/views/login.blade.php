

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{asset('/assets/login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/assets/login/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<!-- <form class="login100-form validate-form"> -->
                {{ Form::open(array('url' => 'login')) }}
					<span class="login100-form-title p-b-26">
						PAPERLESS SYSTEM 
					</span>
					<span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<!-- <div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn">
							{{ Form::submit('Submit!') }}
							</div>
							<button class="login100-form-btn" type="submit">
							</button>
						</div>
					</div> -->

					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit"class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

					<!-- <div class="text-center p-t-115">
						<span class="txt1">
							Don’t have an account?
						</span>

						<a class="txt2" href="#">
							Sign Up
						</a>
                    </div> -->
                    {{ Form::close() }}
                <!-- </form> -->
                
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{asset('/assets/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('/assets/login/vendor/animsition/js/animsition.min.js')}}"></script>
    
	<script src="{{asset('/assets/login/js/main.js')}}"></script>

</body>
</html>