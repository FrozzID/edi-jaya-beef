@extends('frontend.template.master')

@section('active')
<li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Beranda</a></li>
<li class="nav-item active"><a href="{{ url ('menu')}}" class="nav-link">Produk</a></li>
<li class="nav-item"><a href="{{ url('contact') }}" class="nav-link">Kontak</a></li>
@stop

@Auth
@section('cart')
@php
$jumlah=0;
@endphp
@foreach ($carts as $item)
@if ($item->id_user == \Auth::user()->id)
@php
$jumlah = $jumlah +1;
@endphp
@endif
@endforeach
{{$jumlah}}
@stop
@endauth

@section('subtitle')
<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url({{ asset('images/meat-2.jpg') }});"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Product Detail</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ url('/') }}">Beranda</a></span><span>
                            Detail Produk</span>
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>
@stop

@section('content')
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="{{asset('uploads/product/'.$products->input_picture)}}" class="image-popup"><img
                        src="{{asset('uploads/product/'.$products->input_picture)}}" class="img-fluid"
                        alt="Colorlib Template"></a>
            </div>

            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3>{{$products->product_name}}</h3>
                <p class="price"><span>Rp.{{number_format($products->product_price,0,",",".")}}/Kg</span></p>
                <p>{{ $products->description }}</p>
                <p style="color:#c49b63">NOTE : HANYA MELAYANI PENGIRIMAN DAERAH JAKARTA DAN BEKASI</p>
                @auth
                <form enctype="multipart/form-data" class="shop-form"
                    action="{{route('cart.store', [$products->id, \Auth::user()->id])}}" method="POST">
                    @csrf
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <input type="number" id="qty" name="qty" class="form-control input-number" value="1" min="1"
                                required="">
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary py-3 px-4">
                                <font color="white">Add to Cart</font>
                            </button>
                        </div>
                    </div>
                </form>
                @endauth

                @guest
                <div class="row mt-4">
                    <div class="col-md-6">
                        <input type="number" id="qty" name="qty" class="form-control input-number" value="1" min="1">
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('login') }}" class="btn btn-primary py-3 px-4">Add
                            to Cart</a>
                    </div>
                </div>

                @endguest

            </div>
        </div>
    </div>
</section>

{{-- <section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <span class="subheading">Discover</span>
                <h2 class="mb-4">Related products</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
        </div>
        <div class="row">
            @foreach($products as $item)
                <div class="col-md-3">
                    <div class="menu-entry">
                        <a href="#" class="img" style="background-image: url(images/menu-1.jpg);"></a>
                        <div class="text text-center pt-4">
                            <h3><a href="#">Coffee Capuccino</a></h3>
                            <p>A small river named Duden flows by their place and supplies</p>
                            <p class="price"><span>$5.90</span></p>
                            <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
                        </div>
                    </div>
                </div>  
            @endforeach
        </div>
    </div>
</section> --}}
@stop