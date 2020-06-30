<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;

class NotifController extends Controller
{
    public function nofit($id_transaksi)
    {
        $notif['notif'] = Transaction::where([ 
            'status', 'berhasil upload'
        ]);
        return view('navbar', $notif);
        
    }
}
