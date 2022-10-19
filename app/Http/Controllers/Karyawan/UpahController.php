<?php

namespace App\Http\Controllers\Karyawan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

use App\Models\Karyawan;
use App\Models\Tandai;
use App\Models\Jabatan;

class UpahController extends Controller
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
        
        //All karyawan
        $filter = "created_at";
        
        // $karyawan = DB::table('karyawan')
        //     ->where('id_kios', session()->get('idKey'))
        //     ->orderBy($filter, 'DESC')->get();

        $karyawan = Karyawan::leftJoin("tandai", function ($join) {
            $join->on("karyawan.id", "=", "tandai.id_context");
            })
            ->select('karyawan.id as id_karyawan', 'karyawan.nama_lengkap_karyawan', 'karyawan.ponsel_karyawan', 'karyawan.email_karyawan', 'karyawan.jabatan_karyawan', 'karyawan.gaji_karyawan', 'karyawan.updated_at', 'karyawan.status_karyawan', 'tandai.id_tandai', 'tandai.id_context', 'tandai.type_context')
            ->where('karyawan.id_kios', session()->get('idKey'))
            ->orderByRaw('CASE WHEN id_tandai IS NULL then 1 else 0 end, id_tandai') //BUG!!! cannot order by id_tandai, if this var used in a table. But work perfectly in phpmyadmin
            ->get();

        // $total_jabatan = DB::table('karyawan')
        //     ->selectRaw('jabatan_karyawan, sum(gaji_karyawan) as total, count(id) as karyawan_jml')
        //     ->where('id_kios', session()->get('idKey'))
        //     ->groupBy('jabatan_karyawan')->get();

        $total_jabatan = Jabatan::leftJoin("karyawan", function ($join) {
            $join->on("karyawan.jabatan_karyawan", "=", "jabatan.nama_jabatan");
            })
            ->selectRaw('jabatan.nama_jabatan, COALESCE(sum(gaji_karyawan), 0) as total, count(karyawan.id) as karyawan_jml')
            ->where('jabatan.id_kios', session()->get('idKey'))
            ->orderByRaw('CASE WHEN sum(gaji_karyawan) IS NULL then 1 else 0 end')
            ->groupBy('karyawan.jabatan_karyawan')
            ->get();

        // $jabatan = DB::table('jabatan')
        //     ->where('id_kios', session()->get('idKey'))
        //     ->orderBy('created_at', 'DESC')->get();

        $absen = DB::table('absensi')
            ->join('karyawan', 'karyawan.id', '=', 'absensi.id_karyawan')
            ->join('shift', 'shift.id', '=', 'absensi.id_shift')
            ->where('absensi.id_kios', session()->get('idKey'))
            ->orderBy('absensi.waktu_masuk', 'DESC')->get();

        //Set active nav
        session()->put('active_nav', 'karyawan');

        return view ('admin.karyawan.upah.index')
            ->with('rak', $rak)
            ->with('karyawan', $karyawan)
            ->with('absen', $absen)
            //->with('jabatan', $jabatan)
            ->with('total_jabatan', $total_jabatan);
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
    public function unpin($id)
    {
        Tandai::destroy($id);
        return redirect()->back()->with('success_message', 'Pin dilepaskan');
    }

    public function pin($id)
    {
        Tandai::create([
            'id_kios' => session()->get('idKey'),
            'id_context' => $id,
            'type_context' => 'karyawan',
            'created_at' => date("Y-m-d h:m:i"),
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Item ditandai');
    }

    public function edit_upah(Request $request, $id)
    {
        $check = DB::table('karyawan')
            ->select()
            ->where('nama_lengkap_karyawan', $request->nama_lengkap_karyawan)
            ->where('id', $id)
            ->where('id_kios', session()->get('idKey'))
            ->get();

        if(count($check) != 0){
            Karyawan::where('id', $id)->update([
                'gaji_karyawan' => $request->gaji_karyawan,
                'jabatan_karyawan' => $request->jabatan_karyawan,
                'updated_at' => date("Y-m-d h:m:i"),
            ]);
    
            return redirect()->back()->with('success_message', 'Data berhasil diubah');
        } else {
            return redirect()->back()->with('failed_message', 'Edit data gagal, periksa kembali data Anda');
        }
        
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
