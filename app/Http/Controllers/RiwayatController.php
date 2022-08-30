<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //All rak.
        $rak = DB::table('rak')
            ->where('id_kios', session()->get('idKey'))
            ->orderBy('created_at', 'DESC')->get();

        $transaksi = DB::table('keranjang')
            ->select('keranjang.id', 'keranjang.created_at', 'kasir.nama_kasir', 'keranjang.status_keranjang')
            ->join('kasir', 'kasir.id', '=', 'keranjang.id_kasir')
            ->where('keranjang.id_kios', session()->get('idKey'))
            ->orderBy('keranjang.created_at', 'DESC')->get();

        $barang_transaksi = DB::table('barang')
            ->select('barang.id', 'transaksi.id_keranjang', 'barang.nama_barang', 'barang.kategori_barang', 'barang.harga_jual', 'barang.harga_stok', 'transaksi.qty', 'keranjang.bayar')   
            ->join('transaksi', 'transaksi.id_barang', '=', 'barang.id')
            ->join('keranjang', 'keranjang.id', '=', 'transaksi.id_keranjang')
            ->where('keranjang.id_kios', session()->get('idKey'))
            ->orderBy('transaksi.id', 'DESC')->get();

        return view ('admin.riwayat.index')
            ->with('rak', $rak)
            ->with('transaksi', $transaksi)
            ->with('barang_transaksi', $barang_transaksi);
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
