<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cart;

use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // $data['total'] = Cart::where(['id_user' => Auth::user()->id])->count();
    public function index()
    {
        $data['carts'] = Cart::join('products', 'products.id', 'carts.id_product')
            ->select('products.*', 'carts.*')->get();

        return view('User.index', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $id)
    {
        User::where('id', $id->id)
            ->update([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);
        return redirect(url('user', Auth::user()->id));
    }
}
