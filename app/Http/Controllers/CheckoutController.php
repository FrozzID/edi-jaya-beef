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

    public function get_province()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 463395cd94c33d285a0646327474b73f"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //ini kita decode data nya terlebih dahulu
            $response = json_decode($response, true);
            //ini untuk mengambil data provinsi yang ada di dalam rajaongkir resul
            $data_pengirim = $response['rajaongkir']['results'];
            return $data_pengirim;
        }
    }

    public function get_city($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 463395cd94c33d285a0646327474b73f"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            $data_kota = $response['rajaongkir']['results'];
            return json_encode($data_kota);
        }
    }

    public function get_ongkir($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 463395cd94c33d285a0646327474b73f"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            $data_ongkir = $response['rajaongkir']['results'];
            return json_encode($data_ongkir);
        }
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
        return view('checkout', $items, ['cek' => $cek]);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
