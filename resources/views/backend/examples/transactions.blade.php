@extends('backend.master')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                    @php
                    $no = 1;
                    @endphp
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Transaksi</th>
                            <th>Nama Pembeli</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->id_transaksi }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->total }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <div class="col-md-6 mt-2">
                                        <a href="{{ route('admin.transactions.edit',$item->id_transaksi) }}"
                                            class="btn btn-primary"><i class="fa fa-pencil-square-o"
                                                aria-hidden="true"></i>Ubah</a>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <a href="{{ route('admin.transactions.show',$item->id_transaksi) }}"
                                            class="btn btn-secondary">Detail</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop