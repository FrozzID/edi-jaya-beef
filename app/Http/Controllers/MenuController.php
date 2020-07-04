<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Cart;


class MenuController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['products'] = Product::all();
        $data['carts'] = Cart::join('products', 'products.id', 'carts.id_product')
            ->select('products.*', 'carts.*')->get();
        return view('frontend.menu', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::all()->where('slug', $slug)->first();
        $data['carts'] = Cart::join('products', 'products.id', 'carts.id_product')
            ->select('products.*', 'carts.*')->get();
        $this->data['products'] = $product;
        return view('frontend.single-product', $data, $this->data);
    }
}
