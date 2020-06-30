<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- LINEARICONS -->
    <link rel="stylesheet" href="{{asset('vendor/register/fonts/linearicons/style.css')}}">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="{{asset('vendor/register/css/style.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/login/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/login/css/main.css')}}">
    <!--===============================================================================================-->

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>
    <div class="container-login100" style="background-image: url({{asset('vendor/login/images/3582994.jpg')}});">
        <div class="inner">

            <form class="login100-form validate-form p-b-33 p-t-5" action="{{ route('register') }}" method="POST">
                @csrf
                <h3>Create an Account</h3>
                <div class="form-holder">
                    <span class="lnr lnr-user"></span>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name"
                        autofocus class="form-control @error('name') is-invalid @enderror" placeholder="Nama">
                </div>
                <div class="form-holder">
                    <span class="lnr lnr-phone-handset"></span>
                    <input type="number" id="phone_number" name="phone_number"
                        class="form-control @error('phone_number') is-invalid @enderror" required
                        autocomplete="phone_number" placeholder="No Telepon">
                </div>
                <div class="form-holder">
                    <span class="lnr lnr-envelope"></span>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder=" Email">
                </div>
                <div class="form-holder">
                    <span class="lnr lnr-lock"></span>
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" required
                        autocomplete="new-password" placeholder="Password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-holder">
                    <span class="lnr lnr-lock"></span>
                    <input type="password" id="password-confirm" name="password_confirmation" required
                        autocomplete="new-password" class="form-control" placeholder="Confirm Password">
                </div>
                <div class="container-login100-form-btn m-t-32">
                    <button class="login100-form-btn">
                        Register
                    </button>
                    <a class="btn btn-link mt-3" href="{{ url('/login') }}">
                        {{ __('Back') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>