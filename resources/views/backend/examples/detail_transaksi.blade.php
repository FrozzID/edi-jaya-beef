@extends('backend.master')

@section('content')
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-md-12 ftco-animate">
            <a href="{{ route('admin.transactions.index') }}" class="btn btn-primary">Kembali</a>
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
                <a href="{{ route('admin.transactions.edit',$item->id_transaksi) }} "
                    class="btn btn-primary mb-5 col-lg-12">Ubah
                    Status</a>
            </div>
        </div>
        <div class="col-lg-6 mb-5 ftco-animate">
            <div class="card" style="width: 18rem">
                @if($transactions->bukti)
                <a href="{{asset('uploads/bukti/'.$transactions->bukti)}}" class="image-popup"><img
                        src="{{asset('uploads/bukti/'.$transactions->bukti)}}" class="card-img-top"
                        alt="Card image cap"></a>
                @endif

            </div>
        </div>
        <div class="col-lg-6 mb-5 ftco-animate">
            <div class="card">
                <div class="card-body">
                    <p>{{ $transactions->address }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop