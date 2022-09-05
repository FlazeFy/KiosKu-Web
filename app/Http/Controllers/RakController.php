<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Models\Relasi_Rak;
use App\Models\Barang;
use App\Models\Rak;

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

        //Count total profit
        $barang_transaksi = DB::table('barang')
            //->select('barang.nama_barang', 'barang.kategori_barang', 'barang.harga_stok', 'bara')   
            ->join('transaksi', 'transaksi.id_barang', '=', 'barang.id')
            ->join('keranjang', 'keranjang.id', '=', 'transaksi.id_keranjang')
            ->join('relasi_rak', 'relasi_rak.id_barang', '=', 'barang.id')
            ->where('keranjang.id_kios', session()->get('idKey'))
            ->where('relasi_rak.id_rak', $id)
            ->orderBy('transaksi.id', 'DESC')->get();

        $transaksi = DB::table('keranjang')
            ->select('keranjang.id', 'keranjang.created_at')
            ->where('keranjang.id_kios', session()->get('idKey'))
            ->orderBy('keranjang.created_at', 'DESC')->get();

        //All item in current rak
        $barang_rak = DB::table('barang')
            ->select('relasi_rak.id', 'barang.id as id_barang', 'barang.kategori_barang', 'barang.nama_barang', 'barang.deskripsi_barang', 'barang.harga_jual', 'barang.harga_stok', 'barang.stok_barang', 'barang.expired_at')
            ->join('relasi_rak', 'relasi_rak.id_barang', '=', 'barang.id')
            ->join('rak', 'rak.id', '=', 'relasi_rak.id_rak')
            ->where('rak.id', $id)
            ->orderBy('relasi_rak.created_at', 'DESC')->get();

        //All item in shop
        $gudang = DB::table('barang')
            ->where('id_kios', session()->get('idKey'))
            ->orderBy('created_at', 'DESC')->get();

        return view ('admin.rak.index')
            ->with('rak', $rak)
            ->with('open_rak', $open_rak)
            ->with('gudang', $gudang)
            ->with('barang_rak', $barang_rak)
            ->with('barang_transaksi', $barang_transaksi)
            ->with('transaksi', $transaksi);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGudang()
    {
        $gudangData = DB::table('barang')
            ->where('id_kios', session()->get('idKey'))
            ->orderBy('created_at', 'DESC')->get();

        echo json_encode($gudangData);
        //exit;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tambah_rak(Request $request)
    {
        //Create Account validator
        $validator = Validator::make($request->all(), [
            'nama_rak' => 'required|max:20',
            'deskripsi_rak' => 'required|max:100',
        ]);

        if (!$validator->fails()) {
            Rak::create([
                'id_kios' => session()->get('idKey'),
                'nama_rak' => $request->nama_rak,
                'deskripsi_rak' => $request->deskripsi_rak,
                'created_at' => date("Y-m-d h:m:i"),
                'updated_at' => date("Y-m-d h:m:i"),
            ]);

            return redirect()->back()->with('success_message', 'Rak berhasil dibuat');
        } else {
            return redirect()->back()->with('failed_message', 'Gagal menambahkan rak, periksa kembali data Anda');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tambah_barang_rak(Request $request)
    {
        Relasi_Rak::create([
            'id_barang' => $request->id_barang,
            'id_rak' => $request->id_rak,
            'created_at' => date("Y-m-d h:m:i"),
            'updated_at' => date("Y-m-d h:m:i")
        ]);

        return redirect()->back()->with('success_message', 'Rak berhasil dibuat');
    }

    public function edit_foto(Request $request, $id)
    {
        $rak_id = DB::table('rak')->where('id', $id)->get();
        //Get old image url.
        foreach($rak_id as $r){
            $old_image = $r->rak_image_url;
        }

        //Validate image.
        $this->validate($request, [
            'image_url'     => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        //Upload image.
        $new_image = $request->file('image_url');
        $new_image->storeAs('public', $new_image->hashName());
        $imageURL = $new_image->hashName();

        //Delete old image if new image is uploaded.
        if(($request->file('image_url')->isValid())&&($old_image != "null")){
            Storage::delete('public/'.$old_image);
        }

        Rak::where('id', $id)->update([
            'rak_image_url' => $imageURL,
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Foto profil berhasil diperbarui');
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

    public function edit_rak(Request $request, $id)
    {
        Rak::where('id', $id)->update([
            'nama_rak' => $request->nama_rak,
            'deskripsi_rak' => $request->deskripsi_rak,
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Rak berhasil diubah');
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

    public function delete_rak($id)
    {
        Rak::destroy($id);
        return redirect()->back()->with('success_message', 'Rak berhasil dihapus');
    }
}
