@extends('backend.master')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Status Transaksi</h6>
            <p>Kode Transaksi : {{ $transactions->id_transaksi }}</p>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.transactions.update',$transactions->id_transaksi) }}" method="POST">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="status">Status Transaksi</label>
                    <select name="status" required-class="form-control">
                        <option value="{{ $transactions->status }}">Ini Statusnya -> {{ $transactions->status }}
                        </option>
                        <option value="belum bayar">Belum Bayar</option>
                        <option value="berhasil upload">Berhasil Upload</option>
                        <option value="pembayaran terkonfirmasi">Pembayaran Terkonfirmasi</option>
                        <option value="sedang di proses">Sedang di Proses</option>
                        <option value="sedang di kirim">Sedang di Kirim</option>
                        <option value="selesai">Selesai</option>
                        <option value="cancel">Cancel</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Ubah</button>
                <a href="{{route('admin.transactions.index')}}" class="btn btn-danger btn-block">Kembali</a>
            </form>
        </div>
    </div>
</div>
@stop