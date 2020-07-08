@extends('backend.master')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Produk</h1>
        <nav aria-label="breadcrumb text-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.examples.index')}}">Example</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.examples.create')}}">Ubah</a></li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Ubah Product</h6>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" class="form-horizontal"
                        action="{{route('admin.examples.update',$item->id)}}" method="POST">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input_text">Nama Produk</label>
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    placeholder="ex : tenderloin" value="{{ $item->product_name }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input_number">Harga Produk</label>
                                <input type="number" class="form-control" id="product_price" name="product_price"
                                    placeholder="ex : 50000" value="{{ $item->product_price }}">
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
                                <input type="number" class="form-control" id="stok" name="stok" placeholder="ex : 50"
                                    value="{{ $item->stok }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="input_textarea">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description"
                                    rows="3">{{ $item->description }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="hidden" class="form-control" id="slug" name="slug" placeholder="slug"
                                    value="{{ $item->slug }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="input_picture">Masukkan Gambar</label><br>
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
                            <button type="submit" class="btn btn-primary col-12">Ubah</button>
                            <a href="{{ route('admin.examples.index') }}"
                                class="btn btn-danger col-12 mt-1">Batalkan</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection