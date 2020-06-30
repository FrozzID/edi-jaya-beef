@extends('template.master')

@section('active')
<li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
<li class="nav-item"><a href="{{ url ('menu')}}" class="nav-link">Produk</a></li>
<li class="nav-item active"><a href="{{ url('contact') }}" class="nav-link">Contact</a></li>
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
          <h1 class="mb-3 mt-5 bread">Contact Us</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="/">Home</a></span> <span>Contact</span></p>
        </div>

      </div>
    </div>
  </div>
</section>
@stop

@section('content')
<section class="ftco-section contact-section">
  <div class="container mt-5">
    <div class="row block-9">
      <div class="col-md-4 contact-info ftco-animate">
        <div class="row">
          <div class="col-md-12 mb-4">
            <h2 class="h4">Contact Information</h2>
          </div>
          <div class="col-md-12 mb-3">
            <p><span>Address:</span> Jl.Cemerlang No.159 Rt 006/002 Jatibening Baru, Pondok Gede, Kota Bekasi. 17412</p>
          </div>
          <div class="col-md-12 mb-3">
            <p><span>Phone:</span> <a href="http://api.whatsapp.com/send?phone=6281314936072" target="_blank">+62 813
                1493 6072</a></p>
          </div>
          <div class="col-md-12 mb-3">
            <p><span>Email:</span> <a href="mailto:syahrulxtkj01@gmail.com">syahrulxtkj01@gmail.com</a></p>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-6 ftco-animate">
        <div class="row no-gutters">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d495.75431411733007!2d106.93985876812289!3d-6.259184255504883!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698dceb0455463%3A0x3dbd45b314cf52b4!2sdistributor%20daging!5e0!3m2!1sid!2sid!4v1589016497468!5m2!1sid!2sid"
            width="1519" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
            tabindex="0"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

@stop