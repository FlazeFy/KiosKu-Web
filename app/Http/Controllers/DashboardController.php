<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $gudang = DB::table('barang')
            ->where('id_kios', session()->get('idKey'))
            ->orderBy('created_at', 'DESC')->get();

        $rak = DB::table('rak')
            ->where('id_kios', session()->get('idKey'))
            ->orderBy('created_at', 'DESC')->get();

        $absen = DB::table('absensi')
            ->join('karyawan', 'karyawan.id', '=', 'absensi.id_karyawan')
            ->join('shift', 'shift.id', '=', 'absensi.id_shift')
            ->where('absensi.id_kios', session()->get('idKey'))
            ->orderBy('absensi.waktu_masuk', 'DESC')->get();
        
        $barang_rak = DB::table('barang')
            ->join('relasi_rak', 'relasi_rak.id_barang', '=', 'barang.id')
            ->join('rak', 'rak.id', '=', 'relasi_rak.id_rak')
            ->where('rak.id_kios', session()->get('idKey'))
            ->orderBy('relasi_rak.created_at', 'DESC')->get();

        $transaksi = DB::table('keranjang')
            ->select('keranjang.id', 'keranjang.created_at', 'kasir.nama_kasir')
            ->join('kasir', 'kasir.id', '=', 'keranjang.id_kasir')
            ->where('keranjang.id_kios', session()->get('idKey'))
            ->orderBy('keranjang.created_at', 'DESC')->get();

        $barang_transaksi = DB::table('barang')
            //->select('barang.nama_barang', 'barang.kategori_barang', 'barang.harga_stok', 'bara')   
            ->join('transaksi', 'transaksi.id_barang', '=', 'barang.id')
            ->join('keranjang', 'keranjang.id', '=', 'transaksi.id_keranjang')
            ->where('keranjang.id_kios', session()->get('idKey'))
            ->orderBy('transaksi.id', 'DESC')->get();

        $kasir =  DB::table('kasir')
            ->select('kasir.id', 'kasir.created_at', 'kasir.nama_kasir', 'karyawan.nama_karyawan')
            ->join('karyawan', 'karyawan.id', '=', 'kasir.id_karyawan')
            ->where('kasir.id_kios', session()->get('idKey'))
            ->orderBy('kasir.created_at', 'DESC')->get();

        return view ('admin.dashboard.index')
            ->with('transaksi', $transaksi)
            ->with('gudang', $gudang)
            ->with('absen', $absen)
            ->with('barang_rak', $barang_rak)
            ->with('rak', $rak)
            ->with('barang_transaksi', $barang_transaksi)
            ->with('kasir', $kasir);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request, $setting)
    {
        //1 = Week
        //2 = Monthly
        if($setting == "pembeli"){
            $request->session()->put('view_pengunjung_Key', $request->view);
        } else if ($setting == "penjualan"){
            $request->session()->put('view_penjualan_Key', $request->view);
        } else if ($setting == "keuntungan"){
            $request->session()->put('view_keuntungan_Key', $request->view);
        }
        return redirect()->back()->with('success_message', 'Konten berhasil disaring');
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
