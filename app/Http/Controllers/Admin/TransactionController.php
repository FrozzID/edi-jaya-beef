<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Transaction;
use App\DetailTransaction;

use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['transactions'] = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->select('users.*', 'transactions.*')->get();
        $data['title'] = 'List Transactions Table';
        $data['active'] = 'transaksi';
        $data['notif'] = Transaction::where([
            'status' => 'berhasil upload'
        ])->get();
        $data['notifcount'] = Transaction::where([
            'status' => 'berhasil upload'
        ])->count();
        return view('backend.examples.transactions', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_transaksi)
    {
        $data['title'] = 'List Details Transactions';
        $data['active'] = 'transaksi';

        $data['detailtransactions'] = DetailTransaction::join(
            'transactions',
            'transactions.id_transaksi',
            'detail_transactions.id_transaksi'
        )
            ->join('products', 'products.id', 'detail_transactions.id_product')
            ->select('transactions.*', 'detail_transactions.*', 'products.*')
            ->where(['transactions.id_transaksi' => $id_transaksi])->get();

        $total = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->where('id_transaksi', $id_transaksi)->first();
        $this->total['transactions'] = $total;
        $data['notif'] = Transaction::where([
            'status' => 'berhasil upload'
        ])->get();
        $data['notifcount'] = Transaction::where([
            'status' => 'berhasil upload'
        ])->count();
        return view('backend.examples.detail_transaksi', $data,  $this->total);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id_transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit($id_transaksi)
    {
        $data['title'] = 'Edit Produk';
        $data['active'] = 'example';

        $total = Transaction::all()->where('id_transaksi', $id_transaksi)->first();
        $this->total['transactions'] = $total;
        $data['notif'] = Transaction::where([
            'status' => 'berhasil upload'
        ])->get();
        $data['notifcount'] = Transaction::where([
            'status' => 'berhasil upload'
        ])->count();
        return view('backend.examples.edit_transactions', $data, $this->total);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id_transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_transaksi)
    {
        Transaction::where('id_transaksi', $id_transaksi)
            ->update([
                'status' => $request->status,
            ]);

        Alert::success('Sukses !', 'Status berhasil diubah!.');
        return redirect()->route('admin.transactions.index');
    }
}
