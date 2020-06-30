<?php

namespace App\Http\Controllers;

use App\DetailTransaction;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cart;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $item['transactions'] = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->select('users.*', 'transactions.*')->get();
        $item['carts'] = Cart::join('products', 'products.id', 'carts.id_product')
            ->select('products.*', 'carts.*')->get();
        return view('user.transaksi', $item);
    }

    public function detail($id_transaksi)
    {
        $item['detailtransactions'] = DetailTransaction::join('transactions',  'transactions.id_transaksi', 'detail_transactions.id_transaksi')
            ->join('products', 'products.id', 'detail_transactions.id_product')
            ->select('transactions.*', 'detail_transactions.*', 'products.*')->where(['transactions.id_transaksi' => $id_transaksi])->get();

        $total = Transaction::all()->where('id_transaksi', $id_transaksi)->first();
        $this->total['transactions'] = $total;

        $item['carts'] = Cart::join('products', 'products.id', 'carts.id_product')
            ->select('products.*', 'carts.*')->get();

        return view('user.detail_transaksi', $item,  $this->total);
    }

    public function update(Request $request, $id_transaksi)
    {
        if ($request->file('input_picture')) {
            $fileGet = $request->input_picture;
            $fileName = $fileGet->getClientOriginalName();
            $move = $fileGet->move('uploads/bukti', $fileName);
        }

        Transaction::where('id_transaksi', $id_transaksi)
            ->update([
                'status' => "berhasil upload",
                'bukti' => $fileName,
            ]);
        return redirect(url('transaksi'));
    }

    public function selesai(Request $request, $id_transaksi, $user_id)
    {
        Transaction::where(['id_transaksi' => $id_transaksi, 'user_id' => $user_id])
            ->update([
                'status' => "selesai",
            ]);
        return redirect(url('transaksi'));
    }
}
