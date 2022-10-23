<?php

namespace App\Http\Controllers\Akun;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

use App\Models\Riwayat_Kios;

class AktivitasController extends Controller
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

        $riwayat = DB::table('riwayat_kios')
            ->where('id_kios', session()->get('idKey'))
            ->orderBy('created_at', 'DESC')->get();

        //Set active nav
        session()->put('active_nav', 'aktivitas');

        return view ('admin.aktivitas.index')
            ->with('rak', $rak)
            ->with('riwayat', $riwayat);
    }

    public function delete_aktivitas($id)
    {
        Riwayat_Kios::destroy($id);

        return redirect()->back()->with('success_message', 'Riwayat aktivitas berhasil dihapus');
    }

    public function delete_all_aktivitas()
    {
        DB::table('riwayat_kios')->where('id_kios', '=', session()->get('idKey'))->delete();

        return redirect()->back()->with('success_message', 'Riwayat aktivitas berhasil dihapus');
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
