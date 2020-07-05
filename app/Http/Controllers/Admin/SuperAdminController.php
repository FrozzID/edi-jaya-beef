<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Daftar User';
        $data['active'] = 'produk';
        $data['notifcount'] = Transaction::where([
            'status' => 'berhasil upload'
        ])->count();
        $data['users'] = User::all();
        return view('backend.superadmin.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Ubah Roles';
        $data['active'] = 'superadmin';
        $data['notifcount'] = Transaction::where([
            'status' => 'berhasil upload'
        ])->count();
        $item = User::findOrFail($id);
        return view(
            'backend.superadmin.edit',
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::where('id', $id)
            ->update([
                'roles' => $request->roles,
            ]);

        Alert::success('Sukses !', 'Roles Berhasil diubah.');
        return redirect()->route('super-admin.index');
    }
}
