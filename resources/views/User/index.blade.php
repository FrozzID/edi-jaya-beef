@extends('frontend.template.master')

@section('active')
<li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Beranda</a></li>
<li class="nav-item"><a href="{{ url ('menu')}}" class="nav-link">Produk</a></li>
<li class="nav-item"><a href="{{ url('contact') }}" class="nav-link">Kontak</a></li>
@stop

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

@section('content')
<br>
<br>
<br>
<br>
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-10">
            <h1>{{ \Auth::user()->name }}</h1>
        </div>
    </div>
    <div class="row">
        <!--/col-3-->
        <div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home" style="padding-right: 10px">Profil</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                    <form action="{{url('user/'.\Auth::user()->id)}}" class="billing-form ftco-bg-dark p-3 p-md-5"
                        method="POST">
                        @method('put')
                        @csrf
                        <h3 class="mb-4 billing-heading">Detail Profil</h3>
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label>Nama</label>
                                    <input type="text" value="{{\Auth::user()->name}}" class="form-control" name="name"
                                        id="name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label>No. Telepon</label>
                                    <input type="text" value="{{ \Auth::user()->phone_number }}" class="form-control"
                                        id="phone_number" name="phone_number">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ \Auth::user()->email }}" readonly>
                                </div>
                            </div>

                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="streetaddress">Alamat</label>
                                    <textarea name="address" id="address" cols="30" class="form-control" rows="10"
                                        required>{{ Auth::user()->address }}</textarea>
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-primary col-lg-12">Simpan</button>
                    </form> <!-- END -->
                    <hr>
                </div>
            </div>
        </div>
        <!--/tab-content-->
    </div>
    <!--/col-9-->
</div>

@stop

@section('addscript')
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
@endsection