<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Cart;
use Illuminate\Support\Facades\Auth;

use App\Illuminate\Support\Str;
use File;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Arr;
use PDO;

class IndexController extends Controller
{

    public function index()
    {
        $data['products'] = Product::all();
        $data['carts'] = Cart::join('products', 'products.id', 'carts.id_product')
            ->select('products.*', 'carts.*')->get();
        return view('frontend.index', $data);
    }

    public function contact()
    {
        $data['carts'] = Cart::join('products', 'products.id', 'carts.id_product')
            ->select('products.*', 'carts.*')->get();
        return view('frontend.contact', $data);
    }
}
