@extends('backend.master')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Roles User</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('super-admin.update',$item->id) }}" method="POST">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="name">Nama User :</label>
                    <span><strong>{{ $item->name }}</strong></span>
                </div>
                <div class="form-group">
                    <label for="roles">Roles User</label>
                    <select name="roles" required-class="form-control">
                        <option value="">-- Ini Rolesnya -> {{ $item->roles }} --
                        </option>
                        <option value="SUPER">Super Admin</option>
                        <option value="ADMIN">Admin</option>
                        <option value="USER">User</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Ubah</button>
                <a href="{{ route('super-admin.index') }}" class="btn btn-danger btn-block">Kembali</a>
            </form>
        </div>
    </div>
</div>
@stop