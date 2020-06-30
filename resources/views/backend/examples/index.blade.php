@extends('backend.master')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produk </h1>
        <nav aria-label="breadcrumb text-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active0" aria-current="page">Produk</li>
                <li class="breadcrumb-item active"><a href="{{route('admin.examples.create')}}">Insert</a></li>
            </ol>
        </nav>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Produk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga Produk</th>
                            <th>Stok</th>
                            <th>Deskripsi</th>
                            <th>Picutre</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                        <tr>
                            <td>{{$item->product_name}}</td>
                            <td>{{$item->category}}</td>
                            <td>{{$item->product_price}}</td>
                            <td>{{$item->stok }}</td>
                            <td>{{$item->description}}</td>
                            <td>
                                @if ($item->input_picture)
                                <img src="{{ asset('uploads/product/' . $item->input_picture) }}" class="img-fluid"
                                    alt="" width="30%">
                                @else
                                gaada
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <div class="col-md-6 mt-2">

                                        <a href="{{ route('admin.examples.edit',$item->id) }}"
                                            class="btn btn-primary fas fa-edit pr-1" style="color: aliceblue">Edit</a>

                                    </div>
                                    {{-- <form action="{{ route('admin.examples.destroy',$item->id) }}" method="POST"
                                    class="delete">
                                    @csrf
                                    @method('delete') --}}
                                    <div class="col-md-6 mt-2">
                                        <button class="btn btn-danger" data-toggle="modal" data-id="{{ $item->id }}"
                                            data-target="#deleteModal">
                                            <i class="fa fa-trash pr-1">Delete</i>
                                        </button>
                                    </div>
                                    {{-- </form> --}}
                                    <!-- Delete Modal-->
                                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Produk</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Apakah anda yakin ingin menghapusnya?</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('admin.examples.destroy',$item->id) }}"
                                                        method="POST" class="delete">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="id" id="input-id">
                                                        <button class="btn btn-primary btn-delete">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
<!-- /.container-fluid -->
@endsection