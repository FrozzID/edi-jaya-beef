@extends('frontend.template.master')

@section('active')
<li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Beranda</a></li>
<li class="nav-item"><a href="{{ url ('menu')}}" class="nav-link">Produk</a></li>
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

@section('content')
<br>
<br>
<br>
<br>
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-md-12 ftco-animate">

            <div class="billing-form ftco-bg-dark p-3 p-md-5">
                <a href="{{ url('transaksi') }}" class="btn btn-primary">Kembali</a>
                <h3 class="mb-4 billing-heading mt-2">Sukses Check out</h3>
                <p>Pesanan anda sudah di check out selanjutnya untuk pembayaran silahkan transfer ke :
                </p>
                <p style="color:#c49b63">Bank BCA Nomor Rekening : 31-900-38563 a.n Nurelah</p>
                <p style="color:#c49b63">Dengan Nominal : Rp.{{ $transactions->total }}</p>
                <br>
                <h3 class="mb-4 billing-heading">Detail Transaksi</h3>
                <p>Kode Transaksi : {{ $transactions->id_transaksi }}</p>
                @php
                $no = 1;
                @endphp
                <div class="cart-list">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Banyak Produk</th>
                                <th>Harga</th>
                                <th>Jumlah Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailtransactions as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->qty }} Kg</td>
                                <td>{{ $item->product_price }}</td>
                                <td>Rp.{{number_format( $item->jumlah_harga,0,",",".") }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" align="right" style="color:#c49b63">
                                    Total Harga :
                                </td>
                                <td><strong style="color:#c49b63">Rp.{{number_format($item->total,0,",",".")}}</strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @if($transactions->status == "sedang di kirim")
                <div class="card-body">
                    <form enctype="multipart/form-data" class="form-horizontal"
                        action="{{url('transaksi/'.$item->id_transaksi.'/'.Auth::user()->id)}}" method="POST">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn btn-primary col-lg">
                            Selesai
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>

    @endsection