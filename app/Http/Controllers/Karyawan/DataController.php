<?php

namespace App\Http\Controllers\Karyawan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

use App\Models\Karyawan;

class DataController extends Controller
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

        $karyawan = DB::table('karyawan')
            ->where('id_kios', session()->get('idKey'))
            ->orderBy('created_at', 'DESC')->get();

        return view ('admin.karyawan.data.index')
            ->with('rak', $rak)
            ->with('karyawan', $karyawan);
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
    public function edit_karyawan(Request $request, $id)
    {
        Karyawan::where('id', $id)->update([
            'nama_karyawan' => $request->nama_karyawan,
            'nama_lengkap_karyawan' => $request->nama_lengkap_karyawan,
            'gaji_karyawan' => $request->gaji_karyawan,
            'jabatan_karyawan' => $request->jabatan_karyawan,
            'status_karyawan' => $request->status_karyawan,
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Data karyawan berhasil diubah');
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
    public function delete_karyawan($id)
    {
        Karyawan::destroy($id);

        //Delete others karyawan relation
        DB::table('absensi')->where('id_karyawan', '=', $id)->delete();
        DB::table('relasi_kasir')->where('id_karyawan', '=', $id)->delete();

        return redirect()->back()->with('success_message', 'Karyawan berhasil dihapus');
    }
}
