@extends('template.master')

@section('active')
<li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
<li class="nav-item active"><a href="{{ url ('menu')}}" class="nav-link">Produk</a></li>
<li class="nav-item"><a href="{{ url('contact') }}" class="nav-link">Contact</a></li>
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
                    <h1 class="mb-3 mt-5 bread">Our Product</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Home</a></span> <span>Product</span></p>
                </div>

            </div>
        </div>
    </div>
</section>
@stop

@section('content')

<section class="ftco-intro">
    <div class="container-wrap">
        <div class="wrap d-md-flex align-items-xl-end">
            <div class="info" style="width: 100%">
                <div class="row no-gutters">
                    <div class="col-md-3 d-flex ftco-animate">
                        <div class="icon"><span class="icon-phone"></span></div>
                        <div class="text">
                            <h3>(+62) 813 1493 6072</h3>
                            <p>Toko daging sederhana tetapi menyediakan berbagai macam daging.</p>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex ftco-animate">
                        <div class="icon"><span class="icon-my_location"></span></div>
                        <div class="text">
                            <h3>Jl. Cemerlang No. 159 Rt.006/Rw.002</h3>
                            <p> Jatibening Baru, Pondok Gede, Kota Bekasi. 17412</p>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex ftco-animate">
                        <div class="icon"><span class="icon-clock-o"></span></div>
                        <div class="text">
                            <h3>Open Everyday</h3>
                            <p>8:00am - 5:00pm</p>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex ftco-animate">
                        <div class="icon"><span class="flaticon-delivery-truck"></span></div>
                        <div class="text">
                            <h3>Pengiriman</h3>
                            <p>Jakarta - Bekasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-menu mb-5 pb-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Discover</span>
                <h2 class="mb-4">Our Products</h2>
            </div>
        </div>
        <div class="row d-md-flex">
            <div class="col-lg-12 ftco-animate p-md-5">
                <div class="row">
                    <div class="col-md-12 nav-link-wrap mb-5">
                        <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1"
                                role="tab" aria-controls="v-pills-1" aria-selected="true">Daging Sapi</a>
                            <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab"
                                aria-controls="v-pills-2" aria-selected="false">Buntut</a>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex align-items-center">
                        <div class="tab-content ftco-animate" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                                aria-labelledby="v-pills-1-tab">
                                <div class="row">
                                    @foreach ($products as $item)
                                    @if($item->category == 'dg_sapi')
                                    <div class="col-md-4 text-center">
                                        <div class="menu-wrap">
                                            <a href="{{ url ('menu',$item->slug)}}" class="menu-img img mb-4"
                                                style="background-image: url(uploads/product/{{$item->input_picture}}); "></a>
                                            <div class="text">
                                                <h3>
                                                    <a href="{{ url ('menu',$item->slug)}}">{{$item->product_name}}</a>
                                                </h3>
                                                <p style="min-height: 135px;">
                                                    @php
                                                    $first = strtok($item->description, '.');
                                                    echo $first;
                                                    @endphp
                                                </p>
                                                <p class="price">
                                                    <span>Rp.{{number_format($item->product_price,0,",",".")}}</span>
                                                </p>
                                                <p> Stok : {{ $item->stok }} Kg</p>
                                                @auth
                                                <form enctype="multipart/form-data" class="shop-form"
                                                    action="{{route('cart.store', [$item->id, \Auth::user()->id])}}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" id="qty" name="qty"
                                                        class="form-control input-number" value="1" min="1">
                                                    <button type="submit" class="btn btn-primary py-3 px-4">Add
                                                        to Cart</button>
                                                </form>
                                                @endauth

                                                @guest
                                                <a href="{{ url('login') }}" class="btn btn-primary py-3 px-4">Add
                                                    to Cart</a>
                                                @endguest
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
                                <div class="row">
                                    @foreach($products as $item)
                                    @if($item->category == 'buntut')
                                    <div class="col-md-4 text-center">
                                        <div class="menu-wrap">
                                            <a href="{{ url ('menu',$item->slug)}}" class="menu-img img mb-4"
                                                style="background-image: url(uploads/product/{{$item->input_picture}});"></a>
                                            <div class="text">
                                                <h3>
                                                    <a href="{{ url ('menu',$item->slug)}}">{{$item->product_name}}</a>
                                                </h3>
                                                <p style="min-height: 135px;">{{$item->description}}</p>
                                                <p class="price">
                                                    <span>Rp.{{number_format($item->product_price,0,",",".")}}</span>
                                                </p>
                                                <p> Stok : {{ $item->stok }} Kg</p>
                                                @auth
                                                <form enctype="multipart/form-data" class="shop-form"
                                                    action="{{route('cart.store', [$item->id, \Auth::user()->id])}}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" id="qty" name="qty"
                                                        class="form-control input-number" value="1" min="1">


                                                    <button type="submit" class="btn btn-primary py-3 px-4">Add
                                                        to Cart</button>
                                                </form>
                                                @endauth

                                                @guest
                                                <a href="{{ url('login') }}" class="btn btn-primary py-3 px-4">Add
                                                    to Cart</a>
                                                @endguest
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop