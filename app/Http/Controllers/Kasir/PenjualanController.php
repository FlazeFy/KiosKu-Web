<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

use App\Models\Karyawan;
use App\Models\Relasi_Kasir;
use App\Models\Kasir;
use App\Models\Tandai;

class PenjualanController extends Controller
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

        $rel_kasir = DB::table('relasi_kasir')
            ->select('relasi_kasir.id', 'relasi_kasir.id_kasir', 'karyawan.id as id_karyawan', 'karyawan.nama_karyawan', 'karyawan.jabatan_karyawan', 'karyawan.karyawan_image_url')
            ->join('karyawan', 'karyawan.id', '=', 'relasi_kasir.id_karyawan')
            ->where('karyawan.id_kios', session()->get('idKey'))
            ->orderBy('relasi_kasir.created_at', 'DESC')->get();
        
        $transaksi = DB::table('keranjang')
            ->select('keranjang.id', 'keranjang.created_at', 'kasir.id as id_kasir', 'kasir.nama_kasir')
            ->join('kasir', 'kasir.id', '=', 'keranjang.id_kasir')
            ->where('keranjang.id_kios', session()->get('idKey'))
            ->orderBy('keranjang.created_at', 'DESC')->get();

        $barang_transaksi = DB::table('barang')
            //->select('barang.nama_barang', 'barang.kategori_barang', 'barang.harga_stok', 'bara')   
            ->join('transaksi', 'transaksi.id_barang', '=', 'barang.id')
            ->join('keranjang', 'keranjang.id', '=', 'transaksi.id_keranjang')
            ->where('keranjang.id_kios', session()->get('idKey'))
            ->orderBy('transaksi.id', 'DESC')->get();

        // $kasir = DB::table('kasir')
        //     ->where('id_kios', session()->get('idKey'))
        //     ->orderBy('created_at', 'DESC')->get();

        $kasir = Kasir::leftJoin("tandai", function ($join) {
            $join->on("kasir.id", "=", "tandai.id_context")
            ->where('tandai.type_context', 'kasir');
            })
            ->select('kasir.id', 'kasir.nama_kasir', 'kasir.deskripsi_kasir', 'kasir.created_at', 'kasir.updated_at', 'tandai.id_tandai', 'tandai.id_context', 'tandai.type_context')
            ->where('kasir.id_kios', session()->get('idKey'))
            ->groupBy('kasir.id')
            ->orderByRaw('CASE WHEN id_tandai IS NULL then 1 else 0 end, id_tandai')
            ->get();

        //Get karyawan data with tandai and relation with kasir.
        $karyawan = Karyawan::leftJoin("tandai", function ($join) {
            $join->on("karyawan.id", "=", "tandai.id_context")
                ->where('tandai.type_context', 'karyawan')
                ->orWhere('tandai.type_context', null);
            })
            ->leftJoin("relasi_kasir", function ($join) {
                $join->on("karyawan.id", "=", "relasi_kasir.id_karyawan");
            })
            ->select('karyawan.id', 'karyawan.nama_karyawan', 'karyawan.nama_lengkap_karyawan', 'karyawan.ponsel_karyawan', 'karyawan.email_karyawan', 'karyawan.jabatan_karyawan', 'karyawan.gaji_karyawan', 'karyawan.updated_at', 'karyawan.status_karyawan', 'karyawan.karyawan_image_url', 'tandai.id_tandai', 'tandai.id_context', 'tandai.type_context', 'relasi_kasir.id_kasir', 'relasi_kasir.id_karyawan as tersedia')
            ->where('karyawan.id_kios', session()->get('idKey'))
            ->groupBy('karyawan.id')
            ->orderByRaw('CASE WHEN id_tandai IS NULL then 1 else 0 end, id_tandai')
            ->get();

        // $karyawan = Karyawan::leftJoin("tandai", function ($join) {
        //     $join->on("karyawan.id", "=", "tandai.id_context")
        //     ->where('tandai.type_context', 'karyawan');
        //     })
        //     ->select('karyawan.id', 'karyawan.nama_karyawan', 'karyawan.nama_lengkap_karyawan', 'karyawan.ponsel_karyawan', 'karyawan.email_karyawan', 'karyawan.jabatan_karyawan', 'karyawan.gaji_karyawan', 'karyawan.updated_at', 'karyawan.status_karyawan', 'karyawan.karyawan_image_url', 'tandai.id_tandai', 'tandai.id_context', 'tandai.type_context')
        //     ->where('karyawan.id_kios', session()->get('idKey'))
        //     ->groupBy('karyawan.id')
        //     ->orderByRaw('CASE WHEN id_tandai IS NULL then 1 else 0 end, id_tandai')
        //     ->get();
            
        //Set active nav
        session()->put('active_nav', 'kasir');

        return view ('admin.kasir.penjualan.index')
            ->with('rak', $rak)
            ->with('transaksi', $transaksi)
            ->with('karyawan', $karyawan)
            ->with('rel_kasir', $rel_kasir)
            ->with('barang_transaksi', $barang_transaksi)
            ->with('kasir', $kasir);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_kasir(Request $request, $id)
    {
        Kasir::where('id', $id)->update([
            'nama_kasir' => $request->nama_kasir,
            'deskripsi_kasir' => $request->deskripsi_kasir,
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Kasir berhasil diperbarui');
    }

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
            'type_context' => 'kasir',
            'created_at' => date("Y-m-d h:m:i"),
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Item ditandai');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_kasir(Request $request)
    {
        Kasir::create([
            'id_kios' => session()->get('idKey'),
            'nama_kasir' => $request->nama_kasir,
            'deskripsi_kasir' => $request->deskripsi_kasir,
            'created_at' => date("Y-m-d h:m:i"),
            'updated_at' => date("Y-m-d h:m:i")
        ]);

        return redirect()->back()->with('success_message', 'Kasir berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add_karyawan_kasir(Request $request, $id)
    {
        if($request->has('id_karyawan')){
            $karyawan_count = count($request->id_karyawan);
            for($i=0; $i < $karyawan_count; $i++){
                Relasi_Kasir::create([
                    'id_kasir' => $id,
                    'id_karyawan' => $request->id_karyawan[$i],
                    'calendar_type' => $request->calendar_type,
                    'created_at' => date("Y-m-d h:m:i"),
                    'updated_at' => date("Y-m-d h:m:i")
                ]);
            }

            if($karyawan_count > 1){
                return redirect()->back()->with('success_message', 'Berhasil menambahkan '.$karyawan_count.' karyawan ke kasir');
            } else {
                return redirect()->back()->with('success_message', 'Berhasil menambahkan '.$request->nama_lengkap_karyawan.' ke kasir');
            }
        } else {
            return redirect()->back()->with('failed_message', 'Tidak terjadi perubahan. Anda harus memilih setidaknya 1 karyawan');
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
    public function delete_kasir($id)
    {
        Kasir::destroy($id);
        return redirect()->back()->with('success_message', 'Kasir berhasil dihapus');
    }

    public function delete_karyawan_kasir($id){
        Relasi_Kasir::destroy($id);
        return redirect()->back()->with('success_message', 'Karyawan berhasil dihapus');
    }
}
