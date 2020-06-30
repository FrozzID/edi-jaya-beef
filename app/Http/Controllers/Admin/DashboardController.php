<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Transaction;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function __construct()
    {/*  */
        // $this->middleware('auth');
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $data['title'] = 'Dashboard EJB';
        $data['active'] = 'dashboard';
        $data['products'] = Product::all()->count();
        $data['transactions'] = Transaction::all()->count();
        $data['sukses'] = Transaction::where(['status' => 'selesai'])->count();
        $data['cancel'] = Transaction::where(['status' => 'cancel'])->count();
        $data['pending'] = Transaction::where('status', "belum bayar")
            ->orWhere('status', "sedang di kirim")
            ->orWhere('status', "sedang di proses")->orWhere('status', "pembayaran terkonfirmasi")
            ->orWhere('status', "berhasil upload")->count();
        $data['terbaru'] = Transaction::join('users', 'users.id', 'transactions.user_id')
            ->select('users.*', 'transactions.*')->get();
        $data['notif'] = Transaction::where([
            'status' => 'berhasil upload'
        ])->get();
        $data['notifcount'] = Transaction::where([
            'status' => 'berhasil upload'
        ])->count();

        Alert::success('Cheers!', 'Anda berada di dashboard.');
        return view('backend.dashboard', $data);
    }
}
