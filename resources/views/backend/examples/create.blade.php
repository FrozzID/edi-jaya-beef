@extends('backend.master')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Produk</h1>
        <nav aria-label="breadcrumb text-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.examples.index') }}">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Product</h6>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" class="form-horizontal"
                        action="{{route('admin.examples.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="user_id">Admin</label>
                                <select class="form-control" id="user_id" name="user_id">
                                    @foreach ($users as $item)
                                    @if($item->roles == 'ADMIN')
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input_text">Nama Produk</label>
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    placeholder="ex : tenderloin">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="harga_produk">Harga Produk</label>
                                <input type="number" class="form-control" id="product_price" name="product_price"
                                    placeholder="ex : 50000">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input_select">Kategori</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="dg_sapi">Daging Sapi</option>
                                    <option value="dg_kambing">Daging Kambing</option>
                                    <option value="buntut">Buntut</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" placeholder="ex : 50">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="input_textarea">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="input_file">Masukkan Gambar</label><br>
                                <div class="input-group mb-3 col-md-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="input_picture"
                                            name="input_picture">
                                        <label class="custom-file-label" for="input_picture">Pilih Gambar</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary col-12">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection