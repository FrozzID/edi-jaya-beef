@extends('template.master')

@section('active')
<li class="nav-item active"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
<li class="nav-item"><a href="{{ url ('menu')}}" class="nav-link">Produk</a></li>
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
	<div class="slider-item" style="background-image: url({{asset('images/meat-1.jpg')}});">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

				<div class="col-md-8 col-sm-12 text-center ftco-animate">
					<span class="subheading">Welcome</span>
					<h1 class="mb-4">The Best Meat Testing Experience</h1>
					<p class="mb-4 mb-md-5">sell a variety of local and international fresh meat.
					</p>
					<a href="{{ url('menu') }}" class="btn btn-primary p-3 px-xl-4 py-xl-3">View Product</a>
				</div>

			</div>
		</div>
	</div>

	<div class="slider-item" style="background-image: url({{asset('images/meat-2.jpg')}});">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

				<div class="col-md-8 col-sm-12 text-center ftco-animate">
					<span class="subheading">Welcome</span>
					<h1 class="mb-4">Free Ongkir Jakarta Bekasi</h1>
					<p class="mb-4 mb-md-5">Jika Pesanan lebih dari 15Kg</p>
					<a href="{{ url('menu') }}" class="btn btn-primary p-3 px-xl-4 py-xl-3">View Product</a>
				</div>

			</div>
		</div>
	</div>

	<div class="slider-item" style="background-image: url({{asset('images/meat-3.jpg')}});">
		<div class="overlay"></div>
		<div class="container">
			<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

				<div class="col-md-8 col-sm-12 text-center ftco-animate">
					<span class="subheading">Welcome</span>
					<h1 class="mb-4">Hanya melayani pengiriman wilayah Jakarta Bekasi</h1>
					<p class="mb-4 mb-md-5">Pesanan di Proses Paling Lambat 3 hari setelah pemesanan</p>
					<a href="{{ url('menu') }}" class="btn btn-primary p-3 px-xl-4 py-xl-3">View Product</a>
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
							<h3>Jl. Cemerlang No. 159<br> Rt.006/Rw.002</h3>
							<p> Jatibening Baru, Pondok Gede, Kota Bekasi. 17412</p>
						</div>
					</div>
					<div class="col-md-3 d-flex ftco-animate">

						<div class="icon"><span class="icon-clock-o"></span></div>
						<div class="text">
							<h3>Buka Setiap Hari</h3>
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

<section class="ftco-about d-md-flex">
	<div class="one-half img" style="background-image: url({{asset('images/base.jpeg')}});"></div>
	<div class="one-half ftco-animate">
		<div class="overlap">
			<div class="heading-section ftco-animate ">
				<span class="subheading">Discover</span>
				<h2 class="mb-4">Our Story</h2>
			</div>
			<div>
				<p>Berawal dari hanya berjualan di depan rumah dan hanya menjual 1 jenis daging yaitu daging rendang.
					Hingga akhirnya memiliki tempat untuk memperluas area toko dan dapat menambah produk yang dijual di
					toko ini.
				</p>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6 pr-md-5">
				<div class="heading-section text-md-right ftco-animate">
					<span class="subheading">Discover</span>
					<h2 class="mb-4">Our Product</h2>
					<p class="mb-4">Temukan produk yang kami jual selengkapnya disini.</p>
					<p><a href="{{ url('menu') }}" class="btn btn-primary btn-outline-primary px-4 py-3">View Full
							Product</a></p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row">

					@foreach ($products->slice(0,2) as $item)

					<div class="col-md-6">
						<div class="menu-entry">
							<a href="{{ url ('menu',$item->slug)}}" class="img rounded img-fluid"
								style="background-image: url({{asset('uploads/product/'.$item->input_picture)}});"></a>
						</div>
					</div>
					@endforeach
					@foreach ($products->slice(4,2) as $item)

					<div class="col-md-6">
						<div class="menu-entry mt-lg-4">
							<a href="{{ url ('menu',$item->slug)}}" class="img rounded img-fluid"
								style="background-image: url({{asset('uploads/product/'.$item->input_picture)}});"></a>
						</div>
					</div>

					@endforeach

				</div>
			</div>
		</div>
	</div>
</section>
@stop