<?php

namespace App\Http\Controllers\Barang;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use App\Models\Barang;
use App\Models\Tandai;

class GudangController extends Controller
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

        $barang = Barang::leftJoin("tandai", function ($join) {
            $join->on("barang.id", "=", "tandai.id_context")
            ->where('tandai.type_context', 'barang');
            })
            ->select('barang.id', 'barang.nama_barang', 'barang.kategori_barang', 'barang.harga_stok', 'barang.harga_jual', 'barang.deskripsi_barang', 'barang.stok_barang', 'barang.image_url_barang', 'barang.created_at', 'barang.updated_at', 'barang.expired_at', 'tandai.id_tandai', 'tandai.id_context', 'tandai.type_context')
            ->where('barang.id_kios', session()->get('idKey'))
            ->groupBy('barang.id')
            ->orderByRaw('CASE WHEN id_tandai IS NULL then 1 else 0 end, id_tandai')
            ->get();

        $k_barang = DB::table('barang')
            ->select('kategori_barang')
            ->where('id_kios', session()->get('idKey'))
            ->groupBy('kategori_barang')
            ->orderBy('created_at', 'DESC')->get();

        //Set active nav
        session()->put('active_nav', 'barang');

        return view ('admin.barang.gudang.index')
            ->with('rak', $rak)
            ->with('barang', $barang)
            ->with('k_barang', $k_barang);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_barang(Request $request, $id)
    {
        Barang::where('id', $id)->update([
            'deskripsi_barang' => $request->deskripsi_barang,
            'stok_barang' => $request->stok_barang,
            'expired_at' => $request->expired_at,
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Berhasil mengubah data barang');
    }

    public function edit_harga(Request $request, $id)
    {
        Barang::where('id', $id)->update([
            'harga_stok' => $request->harga_stok,
            'harga_jual' => $request->harga_jual,
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Berhasil mengubah harga barang');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_barang(Request $request)
    {
        $total_barang = count($request->nama_barang);
        for($i=0; $i < $total_barang; $i++){
            Barang::create([
                'id_kios' => session()->get('idKey'),
                'nama_barang' => $request->nama_barang[$i],
                'kategori_barang' => $request->kategori_barang[$i],
                'harga_stok' => $request->harga_stok[$i],
                'harga_jual' => $request->harga_jual[$i],
                'deskripsi_barang' => $request->deskripsi_barang[$i],
                'stok_barang' => $request->stok_barang[$i],
                'image_url_barang' => null,
                'created_at' => date("Y-m-d h:m:i"),
                'updated_at' => date("Y-m-d h:m:i"),
                'expired_at' => $request->expired_at[$i]
            ]);
        }

        if($total_barang > 1){
            return redirect()->back()->with('success_message', 'Berhasil menambahkan '.$total_barang.' barang ke gudang');
        } else {
            return redirect()->back()->with('success_message', 'Berhasil menambahkan '.$request->nama_barang[0].' ke gudang');
        }
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
            'type_context' => 'barang',
            'created_at' => date("Y-m-d h:m:i"),
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Item ditandai');
    }

    public function edit_gambar(Request $request, $id)
    {
        $barang_id = DB::table('barang')->where('id', $id)->get();
        //Get old image url.
        foreach($barang_id as $b){
            $old_image = $b->image_url_barang;
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

        Barang::where('id', $id)->update([
            'image_url_barang' => $imageURL,
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Foto barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_barang($id)
    {
        Barang::destroy($id);

        return redirect()->back()->with('success_message', 'Barang berhasil dihapus');
    }
}
