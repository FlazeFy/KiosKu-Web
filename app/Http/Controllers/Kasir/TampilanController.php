<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

use App\Models\Tampilan;

class TampilanController extends Controller
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

        $tampilan = DB::table('tampilan')
            ->where('id_kios', session()->get('idKey'))
            ->orWhere('id_kios', 0)
            ->orderBy('created_at', 'DESC')->get(); 

        //Set active nav
        session()->put('active_nav', 'kasir');

        return view ('admin.kasir.tampilan.index')
            ->with('rak', $rak)
            ->with('tampilan', $tampilan);
    }

    public function tambah_tampilan(Request $request)
    {
        //Check name availability.
        $check = DB::table('tampilan')
            ->select()
            ->where('id_kios', session()->get('idKey'))
            ->where('nama_tampilan', $request->nama_tampilan)
            ->get();

        if(count($check) == 0){
            $old = [];

            if($request->container_awal == 1){
                $old[0]['height'] = "20vh"; 
                $old[0]['width'] = "6"; 
                $old[0]['visibility'] = "Semua"; 
                $old[0]['background'] = "#ffffff"; 
                $old[0]['container_title'] = "Container_1"; 
                $old[0]['info'] = null; 
            }

            $new = json_encode($old); 

            Tampilan::create([
                'id_kios' => session()->get('idKey'),
                'nama_tampilan' => $request->nama_tampilan,
                'format_tampilan' => $new,
                'created_at' => date("Y-m-d h:m:i"),
                'updated_at' => date("Y-m-d h:m:i"),
            ]);

            return redirect()->back()->with('success_message', 'Template tampilan berhasil diperbarui');
        } else {
            return redirect()->back()->with('failed_message', 'Gagal membuat template. Gunakan nama template yang unik');
        }  
    }

    public function hapus_tampilan($id)
    {
        Tampilan::destroy($id);

        return redirect()->back()->with('success_message', 'Template tampilan berhasil dihapus');
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
