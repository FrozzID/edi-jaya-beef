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
          <h1 class="mb-3 mt-5 bread">Cart</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="/">Home</a></span> <span>Cart</span></p>
        </div>
      </div>
    </div>
  </div>
</section>
@stop

@section('content')
<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="row">
      <div class="col-md-12 ftco-animate">
        <div class="cart-list">
          <table class="table">
            <thead class="thead-primary">
              <tr class="text-center">
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              @php
              $total=0;
              $qty = 0;
              @endphp
              @foreach ($carts as $item)
              @if ($item->id_user == \Auth::user()->id)
              <tr class="text-center">
                <td class="product-remove">
                  <form action="{{ route('cart.destroy',$item->id) }}" method="POST" class="delete">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-secondary icon-close px-2"></button>
                  </form>
                </td>
                <td class="image-prod">
                  <div class="img" style="background-image:url(uploads/product/{{$item->input_picture}})"></div>
                </td>
                <td class="product-name">
                  <h3>{{ $item->product_name}}</h3>
                </td>
                <td class="price">Rp.{{number_format($item->product_price,0,",",".")}}/Kg</td>

                <td class="quantity">


                  <div class="input-group mb-3">
                    <input type="number" id="qty-{{$item->id_product}}" name="qty" product="{{ $item->id_product }}"
                      stok="{{ $item->stok }}" price="{{ $item->product_price }}"
                      class="quantity form-control input-number qty" value={{$qty = $item->qty}} min="1"
                      max="{{ $item->stok }}">

                  </div>
                </td>

                <td class="total" id="price-{{$item->id_product}}">
                  Rp.{{number_format($total1 = $item->qty*$item->product_price,0,",",".")}}</td>
              </tr><!-- END TR-->
              @php
              $total = $total + $total1
              @endphp
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @if(!empty($cek))
    <form action="{{ url('') }}">
      <div class="row justify-content-end">
        <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
          <div class="cart-total mb-3">
            <h3>Cart Totals</h3>
            <p class="d-flex">
              <span>Subtotal</span>
              <span class="grand-total">Rp.{{number_format($total,0,",",".")}}</span>
            </p>
          </div>
          <p class="text-center">

            <a href="{{ url('checkout',\Auth::user()->id) }}" class="btn btn-primary py-3 px-4">Proceed to
              Checkout</a>

          </p>
        </div>
      </div>
    </form>
    @endif
  </div>
</section>
@stop


@section('addscript')
<script>
  $(document).ready(function(){
    $('.qty').on("keyup", function(){
      var product = $(this).attr('product');
      var price = $(this).attr('price');
      var total = price * $(this).val();
      $('#price-' + product).html("Rp."+total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));

      updateCart(product, $(this).val());
      countTotal();
    });
  });

  function countTotal(){
    var inputs = $(".qty");
    var grandTotal = 0;
    for(var i = 0; i < inputs.length; i++){
        var price = $(inputs[i]).attr('price');
        var total = price * $(inputs[i]).val();
        grandTotal+=total;
    }

    $('.grand-total').html("Rp."+grandTotal.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
  }

  function updateCart(id, qty){
    $.ajax({
      type: "POST",
      url: "{{ url('/cart/update') }}",
      data: {_token: "{{ csrf_token() }}", id:id, qty:qty},
      dataType: 'json'
    });
  }
</script>

@endsection