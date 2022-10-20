<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use App\Models\Kios;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rak = DB::table('rak')
            ->where('id_kios', session()->get('idKey'))
            ->orderBy('created_at', 'DESC')->get();

        $akun = DB::table('kios')
            ->where('id', session()->get('idKey'))->get();

        //Set active nav
        session()->put('active_nav', 'akun');

        return view ('admin.akun.index')
            ->with('rak', $rak)
            ->with('akun', $akun);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_akun(Request $request, $id)
    {
        $count = 0;
        $username = $request->username;

        if($request->username != $request->username_old){
            $check = DB::table('kios')
                ->select()
                ->where('username', $request->username)
                ->get();
            
            $count = count($check);
            $username = $request->username_old;
        }
        
        if($count == 0){
            Kios::where('id', $id)->update([
                'username' => $request->username,
                'password' => $request->password,
                'nama_kios' => $request->nama_kios,
                'alamat_kios' => $request->alamat_kios,
                'kontak_kios' => $request->kontak_kios,
                'email_kios' => $request->email_kios,
                'deskripsi_kios' => $request->deskripsi_kios,
                'updated_at' => date("Y-m-d h:m:i"),
            ]);

            return redirect()->back()->with('success_message', 'Berhasil mengubah data akun');
        } else {
            return redirect()->back()->with('failed_message', 'Gagal mengubah data, pastikan data telah diisi dengan benar');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
