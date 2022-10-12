<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

use App\Models\Tampilan;

class CustomController extends Controller
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

        $tampilan = DB::table('tampilan')
            ->where('id', $id)
            ->where('id_kios', session()->get('idKey'))
            ->orWhere('id_kios', 0)
            ->orderBy('created_at', 'DESC')->get(); 

        //Set active nav
        session()->put('active_nav', 'kasir');

        return view ('admin.kasir.custom.index')
            ->with('rak', $rak)
            ->with('tampilan', $tampilan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTampilan($id)
    {
        $tampilan = DB::table('tampilan')
            ->where('id_kios', session()->get('idKey'))
            ->orWhere('id_kios', 0)
            ->orderBy('created_at', 'DESC')->get(); 

        echo json_encode($tampilan);
        exit;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit_tampilan(Request $request, $id)
    {
        $key = $request->key;
        $height = $request->height."vh";
        $width = $request->width;
        $visibility = $request->visibility;
        $background = $request->background;
        $title = $request->container_title;
        $info = $request->info;
        $old = $request->old; //Old json format

        $old = json_decode($old, true);

        //Change json by id
        $old[$key]['height'] = $height; 
        $old[$key]['width'] = $width; 
        $old[$key]['visibility'] = $visibility; 
        $old[$key]['background'] = $background; 
        $old[$key]['container_title'] = $title; 
        $old[$key]['info'] = $info; 

        $new = json_encode($old); //New json format

        Tampilan::where('id', $id)->update([
            'format_tampilan' => $new,
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Container berhasil diperbarui');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tambah_container(Request $request, $id)
    {
        $height = $request->height."vh";
        $width = $request->width;
        $visibility = $request->visibility;
        $background = $request->background;
        $title = $request->container_title;
        $info = $request->info;
        $old = $request->old; //Old json format

        $old = json_decode($old);
        $next = count($old) + 1; //new json id

        //Change json by id
        $old[$next]['height'] = $height; 
        $old[$next]['width'] = $width; 
        $old[$next]['visibility'] = $visibility; 
        $old[$next]['background'] = $background; 
        $old[$next]['container_title'] = $title; 
        $old[$next]['info'] = $info; 

        $new = json_encode(array_values($old)); //New json format

        Tampilan::where('id', $id)->update([
            'format_tampilan' => $new,
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Container berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus_container(Request $request, $id)
    {
        $key = $request->key;
        $old = $request->old; //Old json format

        $old = json_decode($old);

        array_splice($old, $key, 1);
        var_dump($old);

        $new = json_encode(array_values($old)); //New json format

        Tampilan::where('id', $id)->update([
            'format_tampilan' => $new,
            'updated_at' => date("Y-m-d h:m:i"),
        ]);

        return redirect()->back()->with('success_message', 'Container berhasil dihapus');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_tampilan_title(Request $request, $id)
    {
        //Check name availability.
        $check = DB::table('tampilan')
            ->select()
            ->where('id_kios', session()->get('idKey'))
            ->where('nama_tampilan', $request->nama_tampilan)
            ->get();

        if(count($check) == 0){
            Tampilan::where('id', $id)->update([
                'nama_tampilan' => $request->nama_tampilan,
                'updated_at' => date("Y-m-d h:m:i"),
            ]);

            return redirect()->back()->with('success_message', 'Template tampilan berhasil diperbarui');
        } else {
            return redirect()->back()->with('failed_message', 'Edit nama template gagal. Gunakan nama template yang unik');
        }  
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
