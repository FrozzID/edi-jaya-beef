@extends('template.master')

@section('active')
<li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
<li class="nav-item"><a href="{{ url ('menu')}}" class="nav-link">Produk</a></li>
<li class="nav-item"><a href="{{ url('contact') }}" class="nav-link">Contact</a></li>
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
        <div class="col-md-12 ftco-animate">

            <div class="billing-form ftco-bg-dark p-3 p-md-5">
                <h3 class="mb-4 billing-heading">Riwayat Transaksi</h3>
                @php
                $no = 1;
                @endphp
                <div class="cart-list">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Transaksi</th>
                                <th>Status</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $item)
                            @if($item->user_id == Auth::user()->id)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->id_transaksi }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->total }}</td>
                                <td>
                                    <a href="{{ url('transaksi/'.$item->id_transaksi) }}"
                                        class="btn btn-primary">Detail</a>
                                    <br>
                                    @if($item->status !== "pembayaran terkonfirmasi" && $item->status !== "selesai" &&
                                    $item->status !== "sedang di proses" && $item->status !== "sedang di kirim" &&
                                    $item->status !== "cancel")
                                    <form enctype="multipart/form-data" class="form-horizontal"
                                        action="{{url('transaksi/'.$item->id_transaksi)}}" method="POST">
                                        @method('put')
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg">
                                                <input type="file" class="btn btn-primary mt-1" id="input_picture"
                                                    name="input_picture">
                                                <button class="btn btn-primary mt-1" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('addscript')
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endsection