<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Cart;
use App\DetailTransaction;
use App\Models\Product;
use App\User;
use Hamcrest\Core\HasToString;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Echo_;

class CheckoutController extends Controller
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
    public function index($id)
    {
        $cek = Cart::where('id_user', $id)->sum('qty');
        $items['carts'] = Cart::join('products', 'products.id', 'carts.id_product')
            ->select('products.*', 'carts.*')->where('id_user', $id)->get();
        return view('frontend.checkout', $items, ['cek' => $cek]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        User::where('id', Auth::user()->id)
            ->update([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);

        $transaction = new Transaction;
        $transaction->user_id = $id;
        $transaction->id_transaksi = $request->id_transaksi;
        $transaction->total = $request->total;

        $transaction->save();

        $carts = Cart::where(['id_user' => Auth::user()->id])->count();

        $a = 'id_product_';
        $b = 'qty_';
        $c = 'jumlah_harga_';
        for ($i = 1; $i <= $carts; $i++) {
            //         # code...
            $p = strval($i);
            $q = $a . $p;
            $r = $b . $p;
            $s = $c . $p;
            $detail = new DetailTransaction;
            $detail->id_product = $request->$q;
            $detail->id_transaksi = $request->id_transaksi;
            $detail->qty = $request->$r;
            $detail->jumlah_harga = $request->$s;

            $detail->save();
        }

        $stoks = Cart::join('products', 'products.id', 'carts.id_product')
            ->select('products.*', 'carts.*')->where('id_user', Auth::user()->id)->get();

        foreach ($stoks as $stok) {
            $menu = Product::where('id', $stok->id_product)->first();
            $menu->stok = $menu->stok - $stok->qty;
            $menu->update();
        }

        $hapus = Cart::where(['id_user' => Auth::user()->id]);
        $hapus->delete();

        return redirect(url('transaksi/' . $request->id_transaksi));
    }
}
