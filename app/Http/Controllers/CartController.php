<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items['carts'] = Cart::join('products', 'products.id', 'carts.id_product')
            ->select('products.*', 'carts.*')->get();
        $items['cek'] = Cart::where(['id_user' => Auth::user()->id])->first();

        return view('frontend.cart', $items);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_product, $id_user)
    {
        $this->validate($request, [
            'qty' => 'required',
        ]);

        $produk = Product::where('id', $id_product)->first();

        if ($request->qty > $produk->stok) {
            return redirect()->route('menu')->with('Pesanan Melebihi Stok');
        }

        $check = Cart::where(['id_product' => $id_product, 'id_user' => $id_user])->first();

        if ($check) {
            $check->qty += $request->qty;
            $check->save();
        } else {
            $cart = new Cart;
            $cart->id_product  = $id_product;
            $cart->id_user  = $id_user;
            $cart->qty  = $request->qty;
            $cart->save();
        }

        return redirect('cart')->with('success', 'Item telah masuk Cart');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'qty' => 'required',
        ]);

        $check = Cart::where(['id_product' => $request->id, 'id_user' => Auth::user()->id])->first();

        if ($check) {
            $check->qty = $request->qty;
            $check->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Cart::findOrFail($id);
        $product->delete();
        return redirect(url('cart'));
    }
}
