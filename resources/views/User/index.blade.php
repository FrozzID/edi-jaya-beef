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
        <div class="col-sm-10">
            <h1>{{ \Auth::user()->name }}</h1>
        </div>
    </div>
    <div class="row">
        <!--/col-3-->
        <div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home" style="padding-right: 10px">Profile</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                    <form action="{{url('user/'.\Auth::user()->id)}}" class="billing-form ftco-bg-dark p-3 p-md-5"
                        method="POST">
                        @method('put')
                        @csrf
                        <h3 class="mb-4 billing-heading">Profile Details</h3>
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
                                    <label>No. HP</label>
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
                        <button class="btn btn-primary py-3 px-4">Save</button>
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

<script>
    $(document).ready(function(){
        //ini ketika provinsi tujuan di klik maka akan eksekusi perintah yg kita mau
        //name select nama nya "provinve_id" kalian bisa sesuaikan dengan form select kalian
        $('select[name="province_id"]').on('change', function(){
            // membuat variable namaprovinsiku untyk mendapatkan atribut nama provinsi
            var namaprovinsiku = $("#province_id option:selected").attr("namaprovinsi");
            // menampilkan hasil nama provinsi ke input id nama_provinsi
            $("#nama_provinsi").val(namaprovinsiku);
            //memberikan action ketika select name kota_id di select
            $('select[name="kota_id"]').on('change', function(){
                // membuat variable namakotaku untyk mendapatkan atribut nama kota
                var namakotaku = $("#kota_id option:selected").attr("namakota");
                // menampilkan hasil nama provinsi ke input id nama_provinsi
                $("#nama_kota").val(namakotaku);
            });
            // kita buat variable provincedid untk menampung data id select province
            let provinceid = $(this).val();
            //kita cek jika id di dpatkan maka apa yg akan kita eksekusi
            if(provinceid){
                // jika di temukan id nya kita buat eksekusi ajax GET
                jQuery.ajax({
                    // url yg di root yang kita buat tadi
                    url:"/kota/"+provinceid,
                    // aksion GET, karena kita mau mengambil data
                    type:'GET',
                    // type data json
                    dataType:'json',
                    // jika data berhasil di dapat maka kita mau apain nih
                    success:function(data){
                        // jika tidak ada select dr provinsi maka select kota kososng / empty
                        $('select[name="kota_id"]').empty();
                        // jika ada kita looping dengan each
                        $.each(data, function(key, value){
                             // perhtikan dimana kita akan menampilkan data select nya, di sini saya memberi name select kota adalah kota_id
                            $('select[name="kota_id"]').append('<option value="'+ value.city_id +'" namakota="'+ value.type +' ' +value.city_name+ '" style="background-color: black">' + value.type + ' ' + value.city_name + '</option>');
                        });
                    }
                });
            }else {
                $('select[name="kota_id"]').empty();
            }
        });
        $('select[name="kurir"]').on('change', function(){
            // kita buat variable untuk menampung data data dari  inputan
            // name city_origin di dapat dari input text name city_origin
            let origin = $("input[name=city_origin]").val();
            // name kota_id di dapat dari select text name kota_id
            let destination = $("select[name=kota_id]").val();
            // name kurir di dapat dari select text name kurir
            let courier = $("select[name=kurir]").val();
            // name weight di dapat dari select text name weight
            let weight = $("input[name=weight]").val();
            // alert(courier);
            if(courier){
                jQuery.ajax({
                    url:"/origin="+origin+"&destination="+destination+"&weight="+weight+"&courier="+courier,
                    type:'GET',
                    dataType:'json',
                    success:function(data){
                        $('select[name="layanan"]').empty();
                        // ini untuk looping data result nya
                        $.each(data, function(key, value){
                            // ini looping data layanan misal jne reg, jne oke, jne yes
                            $.each(value.costs, function(key1, value1){
                                // ini untuk looping cost nya masing masing
                                // silahkan pelajari cara menampilkan data json agar lebi paham
                                $.each(value1.cost, function(key2, value2){
                                    $('select[name="layanan"]').append('<option value="'+ key +'">' + value1.service + '-' + value1.description + '-' +value2.value+ '</option>');
                                });
                            });
                        });
                    }
                });
            }else {
                $('select[name="layanan"]').empty();
            }
        });
        $("#province_id").on("click", function(){  
        var nameprov = $("#province_id option:selected").attr("namaprovinsi");
        nameprovinsi.value=nameprov;
    });
    });
</script>
@endsection