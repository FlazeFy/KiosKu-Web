<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KalenderController extends Controller
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

        //Calendar absensi
        $calender_absensi = DB::table('absensi')
            ->selectRaw(
                "DATE(waktu_masuk) AS date_c, 
                COUNT(case when status_absen = 'Hadir' then 1 else null end) AS Hadir,
                COUNT(case when status_absen = 'Sakit' or status_absen = 'Izin' then 1 else null end) AS SI,
                COUNT(case when status_absen = 'Alpa' then 1 else null end) AS Alpa"
                )
            ->where('id_kios', session()->get('idKey'))
            ->groupBy('date_c')
            ->orderBy('date_c', 'DESC')->get();

        //Calendar total keuntungan
        $calender_keuntungan = DB::table('keranjang')
            ->selectRaw('
                DATE(keranjang.created_at) as date_c,
                sum(transaksi.qty * (barang.harga_jual - barang.harga_stok)) as keuntungan,
                sum(transaksi.qty) as item
            ')
            ->join('transaksi', 'keranjang.id', '=', 'transaksi.id_keranjang')
            ->join('barang', 'barang.id', '=', 'transaksi.id_barang')
            ->where('keranjang.id_kios', session()->get('idKey'))
            ->groupBy('date_c')
            ->orderBy('date_c', 'DESC')->get();

        //Calendar total barang terjual
        $calender_b_terjual =  DB::select( 
            DB::raw("
                SELECT a.date_c as date_c, COALESCE(sum(a.Makanan), 0) as Makanan, COALESCE(sum(a.Sembako), 0) as Sembako
                FROM (SELECT DATE(keranjang.created_at) as date_c,
                CASE WHEN barang.kategori_barang = 'Makanan' THEN SUM(transaksi.qty) END AS Makanan,
                CASE WHEN barang.kategori_barang = 'Sembako' THEN SUM(transaksi.qty) END AS Sembako
                FROM keranjang 
                JOIN transaksi on keranjang.id = transaksi.id_keranjang 
                JOIN barang ON transaksi.id_barang = barang.id 
                WHERE keranjang.id_kios = 1
                GROUP BY date_c, barang.kategori_barang
                ORDER BY date_c DESC) a
                GROUP BY a.date_c
                ORDER BY a.date_c desc"
            ) 
        );


        //Set active nav
        session()->put('active_nav', 'kalender');

        return view ('admin.kalender.index')
            ->with('c_absensi', $calender_absensi)
            ->with('c_keuntungan', $calender_keuntungan)
            ->with('c_b_terjual', $calender_b_terjual)
            ->with('rak', $rak);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $request->session()->put('filter_calendar_key', $request->filtercalender);

        return redirect()->back()->with('success_message', 'Kalender berhasil disaring');
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
