<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use App\Models\Relasi_Rak;
use App\Models\Barang;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        //All rak.
        $rak = DB::table('rak')
            ->where('id_kios', session()->get('idKey'))
            ->orderBy('created_at', 'DESC')->get();
        
        //Current rak.
        $open_rak = DB::table('rak')
            ->where('id', $id)
            ->orderBy('created_at', 'DESC')->get();

        $barang_rak = DB::table('barang')
            ->select('relasi_rak.id', 'barang.id as id_barang', 'barang.kategori_barang', 'barang.nama_barang', 'barang.deskripsi_barang', 'barang.harga_jual', 'barang.harga_stok', 'barang.stok_barang', 'barang.expired_at')
            ->join('relasi_rak', 'relasi_rak.id_barang', '=', 'barang.id')
            ->join('rak', 'rak.id', '=', 'relasi_rak.id_rak')
            ->where('rak.id', $id)
            ->orderBy('relasi_rak.created_at', 'DESC')->get();

        return view ('admin.rak.index')
            ->with('rak', $rak)
            ->with('open_rak', $open_rak)
            ->with('barang_rak', $barang_rak);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit_barang(Request $request, $id)
    {
        Barang::where('id', $id)->update([
            'harga_jual' => $request-> harga_jual,
            'harga_stok' => $request-> harga_stok,
            'stok_barang' => $request-> stok_barang,
            'updated_at' => date("Y-m-d h:m:i"),
            'expired_at' => $request-> expired_at,
        ]);

        return redirect()->back()->with('success_message', 'Barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_barang($id)
    {
        Relasi_Rak::destroy($id);
        return redirect()->back()->with('success_message', 'Barang berhasil dihapus dari rak');
    }
}
