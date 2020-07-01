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

@section('subtitle')
<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url({{ asset('images/meat-2.jpg') }});"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Checkout</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ url('/') }}">Home</a></span>
                        <span>Checkout</span>
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>
@stop

@section('content')
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 ftco-animate">
                <form enctype="multipart/form-data" action="{{route('checkout.store', [\Auth::user()->id])}}"
                    class="billing-form ftco-bg-dark p-3 p-md-5" method="POST">
                    @csrf
                    <h3 class="mb-4 billing-heading">Checkout</h3>
                    <div class="row align-items-end">

                        <div class="col-md-12">
                            <div class="form-group ">
                                @php
                                $date = date("ymd");
                                $kode = strval($date);
                                $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
                                $string1 ='';
                                for($i=0;$i<5;$i++){ $pos=rand(0,strlen($char)-1); $string1 .=$char{$pos}; } @endphp
                                    <input type="text" id="id_transaksi" name="id_transaksi"
                                    value="{{ $kode.$string1.\Auth::user()->id }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="user_name">Nama</label>
                                <input type="text" class="form-control" value="{{ \Auth::user()->name }}" id="name"
                                    name="name">
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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_phone">Phone</label>
                                <input type="text" class="form-control" placeholder=""
                                    value="{{ \Auth::user()->phone_number }}" id="phone_number" name="phone_number">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_phone">Berat</label>
                                <input class="form-control" type="text" value="{{ $cek*1000 ?? '' }} gram" id="weight"
                                    name="weight" readonly>
                            </div>
                        </div>
                        @php
                        $count=1;
                        @endphp
                        @foreach ($carts as $item)
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" type="hidden" value="{{ $item->qty}}" id="qty_{{ $count }}"
                                    name="qty_{{ $count }}">
                                <input class="form-control" type="hidden" value="{{ $item->id_product}}"
                                    id="id_product_{{ $count }}" name="id_product_{{ $count }}">
                                <input class="form-control" type="hidden" value="{{ $item->qty * $item->product_price}}"
                                    id="jumlah_harga_{{ $count }}" name="jumlah_harga_{{ $count }}">
                            </div>
                        </div>
                        @php
                        $count++;
                        @endphp
                        @endforeach
                    </div>

            </div>



            <div class="col-xl-5 sidebar ftco-animate">
                <div class="cart-detail cart-total ftco-bg-dark p-3 p-md-5">

                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                        -- List Produk --
                    </button>

                    <div class="collapse" id="collapseExample">
                        <div class="card" style="background-color: black; width:100%;">
                            <div class="row black">
                                <div class="col-sm-4">
                                    Nama
                                </div>
                                <div class="col-sm-4">
                                    Banyak
                                </div>
                                <div class="col-sm-4">
                                    Total
                                </div>
                            </div>
                            @foreach ($carts as $item)
                            <div class="row black">
                                <div class="col-sm-4">
                                    {{ $item->product_name }}
                                </div>
                                <div class="col-sm-4">
                                    {{ $item->qty }} Kg
                                </div>
                                <div class="col-sm-4">
                                    Rp.{{ number_format( $item->product_price * $item->qty,0,",",".") }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="cart-detail cart-total ftco-bg-dark p-3 p-md-5" style="margin-top: 5%">
                    <p class="d-flex">
                        <span>Subtotal</span>
                        @php $harga=0; @endphp
                        @foreach ($carts as $row)
                        @php
                        $harga=$harga+($row->product_price*$row->qty);
                        @endphp
                        @endforeach
                        <span price="{{ $harga }}" id="price" name="price">Rp.{{number_format($harga,0,",",".")}}</span>

                    </p>
                    @php
                    if ($cek*1000 >= 15000) {
                    $ongkir = 0;
                    }
                    else {
                    $ongkir = $cek*1000;
                    }
                    @endphp
                    <p class="d-flex">
                        <span>Delivery</span>
                        <span id="cost" name="cost" class="cost">Rp.{{number_format($ongkir,0,",",".")}}</span>
                    </p>
                    <hr>
                    <p class="d-flex">
                        <span>Total</span>
                        <span id="grand_total" name="grand_total"
                            style="color:#c49b63">Rp.{{number_format($harga+$ongkir,0,",",".")}}</span>
                        <input type="text" id="total" name="total" value="{{ $harga+$ongkir }}">
                    </p>
                    <button type="submit" class="btn btn-primary py-3 px-4">Place an Order</button>
                </div>
            </div>
            </form> <!-- END -->

        </div>
    </div>
</section> <!-- .section -->

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
                                    $('select[name="layanan"]').append('<option value="'+ value1.description +'" harga="'+value2.value+'" style="background-color: black">' + value1.service + '-' + value1.description + '</option>');
                                    // $('select[name="layanan"]').on('click', function(){
                                    //     $('span[id="cost"]').append(value2.value);
                                    // });
                                });
                            });
                        });            
                    }
                });
            }else {
                $('select[name="layanan"]').empty();
            }
        });
    });

    $("#layanan").on("click", function(){  
        document.getElementById("cost").innerHTML= $("#layanan option:selected").attr("harga"); 
        var grandTotal=0;
        var price = $("#price").attr('price');
        var cost = $("#layanan option:selected").attr("harga");
        var price1 = parseFloat(price);
        var cost1 = parseFloat(cost);
        grandTotal=price1+cost1;
       
        $('#grand_total').html("Rp."+grandTotal.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));  
        $('#cost').html("Rp."+cost1.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
        total.value=grandTotal;
    });
    $("#province_id").on("click", function(){  
        var nameprov = $("#province_id option:selected").attr("namaprovinsi");
        nameprovinsi.value=nameprov;
    });
    
</script>
@endsection