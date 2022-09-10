<?php

namespace App\Http\Controllers\Karyawan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

use App\Models\Karyawan;
use App\Models\Tandai;

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
            ->orderByRaw('CASE WHEN id_tandai IS NULL then 1 else 0 end, id_tandai') //BUG!!! cannot order by id_tandai. But work perfectly in phpmyadmin
            ->get();

        $jabatan = DB::table('karyawan')
            ->selectRaw('jabatan_karyawan, sum(gaji_karyawan) as total, count(id) as karyawan_jml')
            ->where('id_kios', session()->get('idKey'))
            ->groupBy('jabatan_karyawan')->get();

        //Set active nav
        session()->put('active_nav', 'karyawan');

        return view ('admin.karyawan.upah.index')
            ->with('rak', $rak)
            ->with('karyawan', $karyawan)
            ->with('jabatan', $jabatan);
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
            'type_context' => 'table_upah',
            'created_at' => date("Y-m-d h:m:i"),
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Item ditandai');
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
