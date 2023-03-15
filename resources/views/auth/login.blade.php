<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/css/main.css')}}">
    <!--===============================================================================================-->
    <style>
        body {
            font-family: "Literata", sans-serif !important;
        }
        .login100-form-title, .input100, .txt2 {
            font-family: "Literata", sans-serif !important;
        }
    </style>
</head>

<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="{{asset('backend/vendor/img/6.png')}}" alt="IMG">
            </div>
            <form method="post" class="login100-form validate-form">
                @csrf
					<span class="login100-form-title">
						<h1>{{__('login')}}</h1>
					</span>
                @if(isset($msg))
                    <span style="color: red;">{{$msg}}</span>
                @endif

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="email" name="email" placeholder="{{__('email')}}">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100" type="password" name="password" placeholder="{{__('password')}}">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        {{-- <a href="login">Login</a> --}}
                        {{__('login')}}
                    </button>
                </div>

                <div class="text-center p-t-12">
						<span class="txt1">
							{{__('forgot')}}
						</span>
                    <a class="txt2" href="#">
                        {{__('password')}}?
                    </a>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="{{route('register')}}">
                        {{__('create_your_account')}}
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>




<!--===============================================================================================-->
<script src="{{asset('backend/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('backend/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('backend/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('backend/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('backend/vendor/tilt/tilt.jquery.min.js')}}"></script>
<script src="{{asset('js/sweetalert.js')}}"></script>

<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="{{asset('backend/vendor/js/main.js')}}"></script>

</body>
</html>
