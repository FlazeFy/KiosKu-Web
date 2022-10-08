<?php

namespace App\Http\Controllers\Barang;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use App\Models\Barang;

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

        $barang = DB::table('barang')
            ->where('id_kios', session()->get('idKey'))
            ->orderBy('created_at', 'DESC')->get();

        //Set active nav
        session()->put('active_nav', 'barang');

        return view ('admin.barang.gudang.index')
            ->with('rak', $rak)
            ->with('barang', $barang);
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
