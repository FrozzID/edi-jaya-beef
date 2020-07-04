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
                <li class="nav-item"><a href="{{ url('login') }}" class="nav-link">Masuk</a></li>
                @endguest
                @Auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="{{ url('user/'.Auth::user()->id) }}">Profil</a>
                        <a class="dropdown-item" href="{{ url('transaksi') }}">Transaksi</a>

                        <!-- Desktop -->
                        <div class="dropdown-divider"></div>
                        <form action="{{ url('logout') }}" method="POST"
                            class="form-outline d-none d-md-block d-md-none">
                            @csrf
                            <button class="dropdown-item my-2 my-sm-0 px-4">Keluar</button>

                        </form>

                        <!-- Mobile-->
                        <form action="{{ url('logout') }}" method="POST" class="form-outline d-sm-block d-md-none">
                            @csrf
                            <button class="dropdown-item my-2 my-sm-0">Keluar</button>

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