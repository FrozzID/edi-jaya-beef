<!DOCTYPE html>
<html lang="en">


<head>

  <title>EDI JAYA BEEF</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('css/open-iconic-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/animate.css')}}">

  <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">

  <link rel="stylesheet" href="{{asset('css/aos.css')}}">

  <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">

  <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
  <link rel="stylesheet" href="{{asset('css/jquery.timepicker.css')}}">


  <link rel="stylesheet" href="{{asset('css/flaticon.css')}}">
  <link rel="stylesheet" href="{{asset('css/icomoon.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">

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
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">Edi Jaya<small>Beef</small></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
        aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          @yield('active')
          @guest
          <li class="nav-item"><a href="{{ url('login') }}" class="nav-link">Login</a></li>
          @endguest
          @Auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu" aria-labelledby="dropdown04">
              <a class="dropdown-item" href="{{ url('user/'.Auth::user()->id) }}">Profile</a>
              <a class="dropdown-item" href="{{ url('transaksi') }}">Transaksi</a>

              <!-- Desktop -->
              <div class="dropdown-divider"></div>
              <form action="{{ url('logout') }}" method="POST" class="form-outline d-none d-md-block d-md-none">
                @csrf
                <button class="dropdown-item my-2 my-sm-0 px-4">Logout</button>

              </form>

              <!-- Mobile-->
              <form action="{{ url('logout') }}" method="POST" class="form-outline d-sm-block d-md-none">
                @csrf
                <button class="dropdown-item my-2 my-sm-0">Logout</button>

              </form>
            </div>
          </li>
          @endauth

          @guest
          <li class="nav-item cart"><a href="{{ url('login') }}" class="nav-link"><span
                class="icon icon-shopping_cart"></span><span
                class="bag d-flex justify-content-center align-items-center">
                <small>0</small>
              </span>
            </a>
          </li>
          @endguest

          @Auth
          <li class="nav-item cart"><a href="{{ url('cart') }}" class="nav-link"><span
                class="icon icon-shopping_cart"></span><span
                class="bag d-flex justify-content-center align-items-center">
                <small>
                  @yield('cart')</small>
              </span>
            </a>
          </li>
          @endauth

        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  @yield('subtitle')

  @yield('content')

  <footer class="ftco-footer ftco-section img">

    <div class="overlay"></div>
    <div class="container">
      <div class="row mb-5 justify-content-center">
        <div class="col-lg-3 col-md-6 mb-5 mb-md-5">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">About Us</h2>
            <p>Menjual berbagai macam olahan daging sapi lokal dan International.</p>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
              <li class="ftco-animate"><a href="https://www.facebook.com/KillingCrazy" target="_blank"><span
                    class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="https://www.instagram.com/syahrul__ap/" target="_blank"><span
                    class="icon-instagram"></span></a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-5 mb-md-5">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Have a Questions?</h2>
            <div class="block-23 mb-3">
              <ul>
                <li><span class="icon icon-map-marker"></span><span class="text">Jl. Cemerlang No.159 Rt.006/Rw.002,
                    Jatibening Baru, Pondok Gede, Kota Bekasi. 17412</span></li>
                <li><a href="http://api.whatsapp.com/send?phone=6281314936072" target="_blank"><span
                      class="icon icon-phone"></span><span class="text">+62 813 1493 6072</span></a></li>
                <li><a href="mailto:syahrulxtkj01@gmail.com"><span class="icon icon-envelope"></span><span
                      class="text">syahrulxtkj01@gmail.com</span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      {{-- </div> --}}
      <div class="row">
        <div class="col-md-12 text-center">
          <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;
            <script>
              document.write(new Date().getFullYear());
            </script>
            All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by
            <a href="https://colorlib.com" target="_blank">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </p>
        </div>
      </div>
    </div>
  </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
        stroke="#F96D00" />
    </svg>
  </div>

  @include('frontend.partials.script')
  @yield('addscript')

</body>


</html>