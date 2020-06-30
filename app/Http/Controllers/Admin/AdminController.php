<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Models\Product;
use App\Transaction;
use App\DetailTransaction;
use Illuminate\Support\Str;
use File;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Arr;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'List Product Table';
        $data['active'] = 'produk';

        $data['products'] = Product::all();
        $data['notif'] = Transaction::where([
            'status' => 'berhasil upload'
        ])->get();
        $data['notifcount'] = Transaction::where([
            'status' => 'berhasil upload'
        ])->count();
        return view('backend.examples.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Product';
        $data['active'] = 'example';

        $data['users'] = User::get();
        $data['notif'] = Transaction::where([
            'status' => 'berhasil upload'
        ])->get();
        $data['notifcount'] = Transaction::where([
            'status' => 'berhasil upload'
        ])->count();

        return view('backend.examples.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name', 'product_price', 'category', 'input_picture', 'description', 'stok' => 'required',
        ]);

        $product = new Product;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->slug = Str::slug($product->category . '-' . $product->product_name, '-');
        $product->stok = $request->stok;

        if ($request->file('input_picture')) {
            $fileGet = $request->input_picture;
            $fileName = $fileGet->getClientOriginalName();
            $move = $fileGet->move('uploads/product', $fileName);
            $product->input_picture = $fileName;
        }


        $product->save();
        Alert::success('Sukses !', 'Produk Ditambahkan.');
        return redirect()->route('admin.examples.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Edit Produk';
        $data['active'] = 'example';
        $data['notif'] = Transaction::where([
            'status' => 'berhasil upload'
        ])->get();
        $data['notifcount'] = Transaction::where([
            'status' => 'berhasil upload'
        ])->count();

        $item = Product::findOrFail($id);
        return view(
            'backend.examples.edit',
            [
                'item' => $item
            ],
            $data
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->file('input_picture')) {
            $fileGet = $request->input_picture;
            $fileName = $fileGet->getClientOriginalName();
            $move = $fileGet->move('uploads/product', $fileName);
        }

        $slug = Str::slug($request->category . '-' . $request->product_name, '-');

        Product::where('id', $id)
            ->update([
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'category' => $request->category,
                'description' => $request->description,
                'input_picture' => $fileName,
                'slug' => $slug,
                'stok' => $request->stok
            ]);

        Alert::success('Sukses !', 'Produk Berhasil diubah.');
        return redirect()->route('admin.examples.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->delete();
        Alert::success('Sukses !', 'Produk Berhasil dihapus.');
        return redirect()->route('admin.examples.index');
    }

    // public function transactions()
    // {
    //     // dd('sudah sampai sini');
    //     $data['transactions'] = Transaction::join('users', 'users.id', 'transactions.user_id')
    //         ->select('users.*', 'transactions.*')->get();
    //     $data['title'] = 'List Transactions Table';
    //     $data['active'] = 'transaksi';
    //     return view('backend.examples.transactions', $data);
    // }
    // public function detail($id_transaksi)
    // {
    //     $data['title'] = 'List Transactions Table';
    //     $data['active'] = 'transaksi';

    //     $data['detailtransactions'] = DetailTransaction::join('transactions',  'transactions.id_transaksi', 'detail_transactions.id_transaksi')
    //         ->join('products', 'products.id', 'detail_transactions.id_product')
    //         ->select('transactions.*', 'detail_transactions.*', 'products.*')->where(['transactions.id_transaksi' => $id_transaksi])->get();

    //     $total = Transaction::all()->where('id_transaksi', $id_transaksi)->first();
    //     $this->total['transactions'] = $total;
    //     // $this->cek['detail_transactions'] = $cek;
    //     // return $cek;
    //     return view('backend.examples.detail_transaksi', $data,  $this->total);

    //     // return $id_transaksi;
    // }

    // public function ubah($id_transaksi)
    // {
    //     $data['title'] = 'Edit Produk';
    //     $data['active'] = 'example';

    //     $item = Transaction::findOrFail($id_transaksi);

    //     // return view(
    //     //     'backend.examples.edit_transactions',
    //     //     [
    //     //         'item' => $item
    //     //     ],
    //     //     $data

    //     // );
    //     return $item;
    // }
}
